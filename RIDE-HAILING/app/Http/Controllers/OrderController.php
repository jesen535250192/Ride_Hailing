<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_location' => 'required',
            'destination' => 'required',
        ]);

        Order::create([
            'user_id' => auth()->id(),
            'pickup_location' => $request->pickup_location,
            'destination' => $request->destination,
            'pickup_lat' => $request->pickup_lat,
            'pickup_lng' => $request->pickup_lng,
            'price' => 15000,
            'status' => 'pending',
        ]);

        return redirect()->route('history.index');
    }
}