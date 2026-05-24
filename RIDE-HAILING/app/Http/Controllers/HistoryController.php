<?php

namespace App\Http\Controllers;

use App\Models\Order;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', 1)
            ->latest()
            ->get();

        return view('history.index', compact('orders'));
    }
}