<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrdersController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders;
        return view('user-dashboard.orders.index', compact('orders'));
    }

    public function getBarcode(Orders $order)
    {
        return response()->json([
            'barcode' => $order->barcode,
            'order_code' => $order->order_code,
        ]);
    }
}
