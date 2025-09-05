<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $userCurrentBalance = $user->user_current_balance;
        return view('user-dashboard.index', compact('userCurrentBalance'));
    }
}
