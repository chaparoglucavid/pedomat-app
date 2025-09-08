<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\DNS1D;
use Native\Mobile\Dialog;

class PedReservationsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'equipment_id'   => ['required','integer','exists:equipments,id'],
            'quantities'     => ['required','array'],
            'quantities.*'   => ['nullable','integer','min:0'],
            'payment_method' => ['required','in:balance,card'],
        ]);

        $user = Auth::user();
        $method = $data['payment_method'];

        $cart = [];
        foreach (($data['quantities'] ?? []) as $catId => $qty) {
            $q = (int) $qty;
            if ($q > 0) {
                $cart[(int)$catId] = $q;
            }
        }
        if (empty($cart)) {
            return back()->with('error', 'Sifariş üçün ən azı 1 ədəd seçin.')->withInput();
        }

        $equipment = Equipment::with(['ped_categories' => function($q){
            $q->withPivot(['qty_available']);
        }])->findOrFail($data['equipment_id']);

        $items = [];
        $totalQty = 0;
        $totalCents = 0;

        foreach ($equipment->ped_categories as $cat) {
            $catId = (int) $cat->id;
            if (!isset($cart[$catId])) continue;

            $requestedQty = (int) $cart[$catId];
            $available    = (int) $cat->pivot->qty_available;
            if ($requestedQty > $available) {
                return back()
                    ->with('error', "‘{$cat->category_name}’ üçün mövcud say {$available} ədəd-dir.")
                    ->withInput();
            }

            $unitCents = (int) round(((float) $cat->unit_price) * 100);
            $lineCents = $unitCents * $requestedQty;

            $items[] = [
                'cat_id'      => $catId,
                'name'        => $cat->category_name,
                'qty'         => $requestedQty,
                'unit_cents'  => $unitCents,
                'line_cents'  => $lineCents,
                'available'   => $available,
            ];

            $totalQty    += $requestedQty;
            $totalCents  += $lineCents;
        }

        if ($totalQty <= 0 || $totalCents <= 0) {
            return back()->with('error', 'Sifariş boşdur.')->withInput();
        }

        if ($method === 'card') {
            // Burada kart ödənişi üçün yönləndirmə/gateway inteqrasiyası olacaq.

            return back()->with('info', 'Kart ödənişi hələ inteqrasiya edilməyib.');
        }

        try {
            $result = DB::transaction(function () use ($user, $equipment, $items, $totalCents, $data) {

                /** @var User $freshUser */
                $freshUser = User::query()->find($user->id);

                $userBalanceCents = (int) round(((float) $freshUser->current_balance) * 100);

                if ($userBalanceCents < $totalCents) {
                    throw new \RuntimeException('Balans kifayət etmir.');
                }

                $eq = Equipment::with(['ped_categories' => function($q){
                    $q->withPivot(['qty_available']);
                }])->findOrFail($equipment->id);

                $pivotRel = $eq->ped_categories();

                foreach ($items as $row) {
                    $cat = $eq->ped_categories->firstWhere('id', $row['cat_id']);
                    if (!$cat) {
                        throw new \RuntimeException('Kateqoriya tapılmadı: '.$row['cat_id']);
                    }
                    $avail = (int) $cat->pivot->qty_available;
                    if ($row['qty'] > $avail) {
                        throw new \RuntimeException("‘{$cat->category_name}’ üçün mövcud say dəyişdi (hazırda {$avail}).");
                    }

                    $newAvail = $avail - $row['qty'];

                    $pivotRel->updateExistingPivot($row['cat_id'], ['qty_available' => $newAvail]);
                }


                $newBalanceCents = $userBalanceCents - $totalCents;
                $freshUser->current_balance = $newBalanceCents / 100;
                $freshUser->save();


                $orderId = null;
                $orderCode = 'ORD'.date('ymdHis').str_pad((string)$freshUser->id, 4, '0', STR_PAD_LEFT);

                if (Schema::hasTable('orders')) {
                    $orderId = DB::table('orders')->insertGetId([
                        'user_id'       => $freshUser->id,
                        'equipment_id'  => $eq->id,
                        'order_code'    => $orderCode,
                        'total_amount'  => $totalCents / 100,
                        'currency'      => 'AZN',
                        'payment_method'=> 'balance',
                        'status'        => 'paid',
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }

                if (Schema::hasTable('order_items')) {
                    foreach ($items as $row) {
                        DB::table('order_items')->insert([
                            'order_id'     => $orderId,
                            'category_id'  => $row['cat_id'],
                            'name'         => $row['name'],
                            'qty'          => $row['qty'],
                            'unit_price'   => $row['unit_cents'] / 100,
                            'line_total'   => $row['line_cents'] / 100,
                            'created_at'   => now(),
                            'updated_at'   => now(),
                        ]);
                    }
                }

                if (Schema::hasTable('wallet_transactions')) {
                    DB::table('wallet_transactions')->insert([
                        'user_id'     => $freshUser->id,
                        'type'        => 'debit',
                        'amount'      => $totalCents / 100,
                        'currency'    => 'AZN',
                        'meta'        => json_encode([
                            'equipment_id' => $eq->id,
                            'order_id'     => $orderId,
                            'items'        => collect($items)->map(fn($r)=>[
                                'cat_id'=>$r['cat_id'], 'qty'=>$r['qty'], 'unit'=>$r['unit_cents']/100
                            ])->values(),
                        ]),
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }

                return [$orderId, $orderCode, $newBalanceCents];
            }, 3);

        } catch (\Throwable $e) {
            Log::error('Balance payment failed: '.$e->getMessage());
            if (str_contains($e->getMessage(), 'Balans kifayət etmir')) {
                return back()->with('error', 'Balansınız kifayət etmir. Zəhmət olmasa balansınızı artırın.')->withInput();
            }
            return back()->with('error', 'Sifarişi icra etmək mümkün olmadı. Xahiş edirik yenidən cəhd edin.')->withInput();
        }

        [$orderId, $orderCode, $newBalanceCents] = $result;

        $barcode = new DNS1D();
        $barcodeHtml = $barcode->getBarcodeHTML($orderCode, 'PHARMA2T');

        $sumAZN = number_format($totalCents/100, 2, '.', ' ');
        $balAZN = number_format($newBalanceCents/100, 2, '.', ' ');

        $barcode = new DNS1D();
        return $barcode->getBarcodeHTML('120101030', 'PHARMA2T');
    }
}
