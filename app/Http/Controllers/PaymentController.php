<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::whereHas('order', function ($query) {
        $query->where('user_id', auth()->id());
            })
            ->with('order.user')
            ->latest()
            ->get();

        return view('payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $order = Order::with('payment', 'user')
            ->where('user_id', auth()->id())
            ->findOrFail($request->order);
        if ($order->payment) {
            return redirect()
                ->route('history.index')
                ->with('error', 'Order sudah dibayar.');
        }

        return view('payments.create', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required',
        ]);

        $order = Order::with('payment')
            ->where('user_id', auth()->id())
            ->findOrFail($request->order_id);

        // Cegah pembayaran ganda
        if ($order->payment) {
            return redirect()
                ->route('history.index')
                ->with('error', 'Order sudah dibayar.');
        }

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount' => $order->price,
            'status' => 'Paid',
            'transaction_date' => now(),
        ]);

        // Status order TIDAK diubah.
        // Driver tetap melanjutkan alur:
        // pending -> accepted -> on_the_way -> completed

        return redirect()
            ->route('payments.index')
            ->with('success', 'Pembayaran berhasil.');
    }

    public function show(Payment $payment)
    {
        if ($payment->order->user_id != auth()->id()) {
            abort(403);
        }

        $payment->load('order.user');

        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        //
    }

    public function update(Request $request, Payment $payment)
    {
        //
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment berhasil dihapus.');
    }
}