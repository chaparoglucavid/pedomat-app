<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use App\Models\PedCategories;
use App\Models\User;
use App\Models\Orders;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;
use Barryvdh\DomPDF\Facade\Pdf;
use Native\Mobile\Dialog;

class PedReservationsController extends Controller
{
    /**
     * Balance payment only — create order, generate invoice PDF, store barcode & invoice on orders table.
     */
    public function store(Request $request)
    {
        $orderCodeForLog = null; // log konteksti üçün

        try {
            // 0) Auth
            $userId = Auth::id();
            if (!$userId) {
                (new Dialog())->toast('Sessiya başa çatıb. Yenidən daxil olun.');
                return redirect()->back()->withInput();
            }

            // 1) Validation
            try {
                $data = $request->validate([
                    'equipment_id'   => 'required|integer|exists:equipments,id',
                    'quantities'     => 'required|array|min:1',
                    'quantities.*'   => 'required|integer',
                ]);
            } catch (ValidationException $ve) {
                Log::error('Order validation failed', [
                    'user_id' => $userId,
                    'errors'  => $ve->errors(),
                    'input'   => $request->except(['_token']), // ehtiyatla
                ]);
                (new Dialog())->toast('Məlumatlar düzgün deyil. Xahiş edirik yoxlayın.');
                return redirect()->back()->withInput();
            }

            // 2) Equipment (burada saxlayırıq ki, ModelNotFoundException loglansın)
            try {
                $equipment = Equipments::with(['ped_categories:id,category_name,unit_price'])
                    ->findOrFail($data['equipment_id']);
            } catch (ModelNotFoundException $mnfe) {
                Log::error('Equipment not found', [
                    'user_id'      => $userId,
                    'equipment_id' => $data['equipment_id'] ?? null,
                ]);
                (new Dialog())->toast('Avadanlıq tapılmadı.');
                return redirect()->back()->withInput();
            }

            // 3) İcazəli kateqoriyalara uyğun sorğu formalaşdır
            $allowedCatIds = $equipment->ped_categories->pluck('id')->map(fn($v) => (int)$v)->all();

            $requested = [];
            foreach ($data['quantities'] as $catId => $qty) {
                $cid = (int)$catId;
                $q   = (int)$qty;
                if ($q > 0 && in_array($cid, $allowedCatIds, true)) {
                    $requested[$cid] = $q;
                }
            }

            if (empty($requested)) {
                Log::error('Empty order (no valid requested items)', [
                    'user_id'      => $userId,
                    'equipment_id' => $equipment->id,
                    'input'        => $data['quantities'] ?? [],
                ]);
                (new Dialog())->toast('Sifariş üçün ən azı 1 ədəd seçin.');
                return redirect()->back()->withInput();
            }

            // 4) Transaction
            [$orderId, $orderCodeForLog] = DB::transaction(function () use ($userId, $equipment, $requested) {
                /** @var User $user */
                $user = User::query()->lockForUpdate()->findOrFail($userId);
                $userBalanceCents = self::toCents($user->user_current_balance);

                // Pivot sətirlərini kilidlə
                $pivotRows = DB::table('equipment_ped_stocks')
                    ->where('equipment_id', $equipment->id)
                    ->whereIn('ped_category_id', array_keys($requested))
                    ->lockForUpdate()
                    ->get();

                if ($pivotRows->count() !== count($requested)) {
                    Log::error('Pivot rows count mismatch', [
                        'user_id'      => $user->id,
                        'equipment_id' => $equipment->id,
                        'requested_ids'=> array_keys($requested),
                        'found_count'  => $pivotRows->count(),
                    ]);
                    throw new \RuntimeException('Bəzi kateqoriyalar bu avadanlıq üçün tapılmadı.');
                }

                // Qiymətləri yenidən götür
                $cats = PedCategories::query()
                    ->select(['id', 'category_name', 'unit_price'])
                    ->whereIn('id', array_keys($requested))
                    ->get()
                    ->keyBy('id');

                $finalItems = [];
                $totalQty   = 0;
                $totalCents = 0;

                foreach ($requested as $catId => $qty) {
                    $pivot = $pivotRows->firstWhere('ped_category_id', (int)$catId);
                    if (!$pivot) {
                        Log::error('Pivot row missing for category', [
                            'user_id'      => $user->id,
                            'equipment_id' => $equipment->id,
                            'cat_id'       => $catId,
                        ]);
                        throw new \RuntimeException("Kateqoriya tapılmadı: {$catId}");
                    }

                    $available = (int)$pivot->qty_available;
                    if ($qty > $available) {
                        $name = $cats[$catId]->category_name ?? ('#'.$catId);
                        Log::error('Insufficient stock', [
                            'user_id'      => $user->id,
                            'equipment_id' => $equipment->id,
                            'cat_id'       => $catId,
                            'requested'    => $qty,
                            'available'    => $available,
                        ]);
                        throw new \RuntimeException("‘{$name}’ üçün mövcud say {$available}-dir.");
                    }

                    $cat        = $cats[$catId];
                    $unitCents  = self::toCents($cat->unit_price);
                    $lineCents  = $unitCents * $qty;

                    $finalItems[] = [
                        'cat_id'     => (int)$catId,
                        'name'       => (string)$cat->category_name,
                        'qty'        => (int)$qty,
                        'unit_cents' => $unitCents,
                        'line_cents' => $lineCents,
                        'available'  => $available,
                    ];

                    $totalQty   += $qty;
                    $totalCents += $lineCents;
                }

                if ($totalQty <= 0 || $totalCents <= 0) {
                    Log::error('Order totals invalid', [
                        'user_id'      => $user->id,
                        'equipment_id' => $equipment->id,
                        'totalQty'     => $totalQty,
                        'totalCents'   => $totalCents,
                    ]);
                    throw new \RuntimeException('Sifariş boşdur.');
                }

                if ($userBalanceCents < $totalCents) {
                    Log::error('Insufficient balance', [
                        'user_id'      => $user->id,
                        'balance_cents'=> $userBalanceCents,
                        'total_cents'  => $totalCents,
                    ]);
                    throw new \RuntimeException('Balans kifayət etmir.');
                }

                foreach ($finalItems as $row) {
                    DB::table('equipment_ped_stocks')
                        ->where('equipment_id', $equipment->id)
                        ->where('ped_category_id', $row['cat_id'])
                        ->update([
                            'qty_available' => $row['available'] - $row['qty'],
                            'updated_at'    => now(),
                        ]);
                }

                $newBalanceCents = $userBalanceCents - $totalCents;
                $user->user_current_balance = self::fromCents($newBalanceCents);
                $user->save();

                $orderCode   = 'ORD-' . now()->format('Ymd-His');
                $dns         = new DNS1D();
                $barcodeHtml = $dns->getBarcodeSVG($orderCode, 'C128');

                $order = Orders::create([
                    'user_id'          => $user->id,
                    'equipment_id'     => $equipment->id,
                    'order_number'       => $orderCode,
                    'order_qty_sum'    => $totalQty,
                    'order_amount_sum' => self::fromCents($totalCents),
                    'payment_method'   => 'balance',
                    'payment_status'   => 'completed',
                    'barcode'          => $barcodeHtml,
                    'barcode_status'   => 'not_used',
                    'invoice'          => null,
                ]);

                foreach ($finalItems as $row) {
                    OrderDetails::create([
                        'order_id'        => $order->id,
                        'ped_category_id' => $row['cat_id'],
                        'qty'             => $row['qty'],
                        'unit_price'      => self::fromCents($row['unit_cents']),
                        'total_price'     => self::fromCents($row['line_cents']),
                    ]);
                }

                // PDF invoice
                $pdf = Pdf::loadView('orders.invoice', [
                    'order'     => $order,
                    'items'     => $finalItems,
                    'user'      => $user->fresh(),
                    'equipment' => $equipment,
                    'paid_at'   => now(),
                ]);

                $relativePath = 'documents/orders/invoices/' . $order->order_code . '_' . time() . '.pdf';
                Storage::disk('public')->put($relativePath, $pdf->output());

                $order->invoice = Storage::url($relativePath);
                $order->save();

                return [$order->id, $order->order_code];
            }, 3);

            // Uğurlu yönləndirmə
            return redirect()
                ->route('user-dashboard')
                ->with('success', "Sifariş yaradıldı (#{$orderCodeForLog}).");

        } catch (ModelNotFoundException $e) {
            Log::error('Order flow: model not found', [
                'user_id'    => Auth::id(),
                'message'    => $e->getMessage(),
                'order_code' => $orderCodeForLog,
            ]);
            (new Dialog())->toast('Məlumat tapılmadı.');
            return redirect()->back()->withInput();

        } catch (ValidationException $e) {
            // (praktik olaraq yuxarıda tutulur, amma fallback olaraq saxlayırıq)
            Log::error('Order flow: validation exception', [
                'user_id' => Auth::id(),
                'errors'  => $e->errors(),
                'order_code' => $orderCodeForLog,
            ]);
            (new Dialog())->toast('Məlumatlar düzgün deyil.');
            return redirect()->back()->withInput();

        } catch (\Exception $e) {
            Log::error('Order (balance) failed', [
                'user_id'    => Auth::id(),
                'message'    => $e->getMessage(),
                'trace'      => $e->getTraceAsString(),
                'order_code' => $orderCodeForLog,
            ]);

            $msg = str_contains($e->getMessage(), 'Balans kifayət etmir')
                ? 'Balansınız kifayət etmir. Zəhmət olmasa balansınızı artırın.'
                : 'Sifarişi icra etmək mümkün olmadı. Xahiş edirik yenidən cəhd edin.';

            (new Dialog())->toast($msg);
            return redirect()->back()->withInput();
        }
    }
    private static function toCents($amount): int
    {
        return (int)round(((float)$amount) * 100);
    }

    private static function fromCents(int $cents): float
    {
        return $cents / 100;
    }

}
