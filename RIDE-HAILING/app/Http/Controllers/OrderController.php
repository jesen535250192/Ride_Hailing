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

    $destination = strtolower($request->destination);

    $price = 15000;

    if ($destination == 'tangerang') {
        $price = 15000;
    } elseif ($destination == 'papua') {
        $price = 500000;
    } elseif ($destination == 'bandung') {
        $price = 120000;
    } elseif ($destination == 'bekasi') {
        $price = 30000;
    }

    Order::create([
        'user_id' => auth()->id(),
        'pickup_location' => $request->pickup_location,
        'destination' => $request->destination,
        'pickup_lat' => $request->pickup_lat,
        'pickup_lng' => $request->pickup_lng,
        'price' => $price,
        'status' => 'pending',
    ]);

    return redirect()->route('history.index');
}
}