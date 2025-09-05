<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\UserBalanceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Native\Mobile\Dialog;

class UserBalanceController extends Controller
{
    public function index()
    {
        return view('user-dashboard.balance.index');
    }

    public function userBalanceHistory()
    {
        $user = Auth::user();
        $balance_history = $user->user_balance_history()->orderBy('created_at', 'desc')->get();
        $current_balance = $user->user_current_balance;

        $this_month_transactions = $user->user_balance_history()->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount');
        return view('user-dashboard.balance.history', compact('balance_history', 'current_balance', 'this_month_transactions'));
    }

    public function topUpWalletBalance(Request $request)
    {
        return view('user-dashboard.balance.top-up-wallet-balance');
    }

    public function topUpWalletBalancePost(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();

        DB::beginTransaction();

        try {
            $transactionNumber = 'BA-' . strtoupper(Str::random(10));

            $history = UserBalanceHistory::create([
                'user_id'           => $user->id,
                'transaction_number'=> $transactionNumber,
                'amount'            => $validated['amount'],
                'payment_via'       => 'via_card',
                'payment_status'    => 200,
            ]);

            $user->increment('user_current_balance', $validated['amount']);

            DB::commit();

            (new Dialog())->toast('Balans müvəffəqiyyətlə artırıldı!');
            return redirect()->route('user-dashboard');

        } catch (\Throwable $th) {
            DB::rollBack();

            dd($th->getMessage());
            Log::error('Top-up failed', [
                'user_id' => $user->id ?? null,
                'error'   => $th->getMessage(),
            ]);

            (new Dialog())->toast('Balans artırılarkən xəta baş verdi. Zəhmət olmasa yenidən yoxlayın.');
            return redirect()->back()->withInput();
        }
    }
}
