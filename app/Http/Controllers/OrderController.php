<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Form membuat order
     */
    public function create()
    {
        abort_if(auth()->user()->role != 'customer', 403);

        return view('order.create');
    }

    /**
     * Simpan order baru
     */
    public function store(Request $request)
    {
        abort_if(auth()->user()->role != 'customer', 403);

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

            'destination_lat' => $request->dest_lat,
            'destination_lng' => $request->dest_lng,

            'price' => $price,

            'status' => 'pending',
        ]);
        return redirect()->route('history.index')
            ->with('success', 'Order berhasil dibuat.');
    }

    /**
     * Daftar order yang belum diambil driver
     */
    public function driverOrders()
    {
        abort_if(auth()->user()->role != 'driver', 403);

        $orders = Order::whereNull('driver_id')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('driver.orders', compact('orders'));
    }

    /**
     * Semua order milik driver
     */
    public function myDriverOrders()
    {
        abort_if(auth()->user()->role != 'driver', 403);

        $orders = Order::where('driver_id', auth()->id())
            ->latest()
            ->get();

        return view('driver.my-orders', compact('orders'));
    }

    /**
     * Update status order
     */
    public function updateStatus($id, $status)
    {
        abort_if(auth()->user()->role != 'driver', 403);

        $allowedStatus = [
            'accepted',
            'on_the_way',
            'completed',
        ];

        if (!in_array($status, $allowedStatus)) {
            abort(404);
        }

        $order = Order::findOrFail($id);

        /**
         * Driver menerima order
         */
        if ($status == 'accepted') {

            // Order sudah diambil driver lain
            if ($order->driver_id != null) {
                return back()->with('error', 'Order sudah diambil driver lain.');
            }

            // Driver tidak boleh menerima order miliknya sendiri
            if ($order->user_id == auth()->id()) {
                return back()->with('error', 'Anda tidak dapat mengambil order milik sendiri.');
            }

            $order->driver_id = auth()->id();
            $order->status = 'accepted';
            $order->save();

            return redirect()
                ->route('driver.my.orders')
                ->with('success', 'Order berhasil diterima.');
        }

        /**
         * Setelah accepted hanya driver pemilik order
         * yang boleh mengubah status
         */
        if ($order->driver_id != auth()->id()) {
            abort(403);
        }

        $order->status = $status;
        $order->save();

        return redirect()
            ->route('driver.my.orders')
            ->with('success', 'Status order berhasil diperbarui.');
    }

    /**
     * Pendapatan Driver
     */
    public function driverIncome()
    {
        abort_if(auth()->user()->role != 'driver', 403);

        $orders = Order::where('driver_id', auth()->id())
            ->where('status', 'completed')
            ->latest()
            ->get();

        $totalIncome = $orders->sum('price');

        return view('driver.income', compact('orders', 'totalIncome'));
    }
}