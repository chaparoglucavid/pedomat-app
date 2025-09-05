<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserTransactionsController extends Controller
{
    public function index()
    {
        return view('user-dashboard.transactions.index');
    }
}
