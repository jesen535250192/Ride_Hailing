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
            'distance' => 'required|numeric',
        ]);

        $distance = $request->distance;
        $price = ceil($distance * 10000);

        Order::create([
            'user_id' => auth()->id(),
            'pickup_location' => $request->pickup_location,
            'destination' => $request->destination,

            'pickup_lat' => $request->pickup_lat,
            'pickup_lng' => $request->pickup_lng,

            'dest_lat' => $request->dest_lat,
            'dest_lng' => $request->dest_lng,

            'distance' => $distance,
            'price' => $price,

            'status' => 'pending',
        ]);

        return redirect()->route('history.index');
    }

    public function driverOrders()
    {
        $orders = Order::whereNull('driver_id')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('driver.orders', compact('orders'));
    }

    public function myDriverOrders()
    {
        $orders = Order::where('driver_id', auth()->id())
            ->whereIn('status', ['accepted', 'on_the_way'])
            ->latest()
            ->get();

        return view('driver.my-orders', compact('orders'));
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);

        if ($status == 'accepted' && $order->driver_id == null) {
            $order->driver_id = auth()->id();
        }

        $order->status = $status;
        $order->save();

        return redirect()->route('driver.my.orders');
    }

    public function driverIncome()
    {
        $orders = Order::where('driver_id', auth()->id())
            ->where('status', 'completed')
            ->latest()
            ->get();

        $totalIncome = $orders->sum('price');

        return view('driver.income', compact('orders', 'totalIncome'));
    }
}