<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Menampilkan form rating
     */
    public function create(Order $order)
    {
        // Hanya customer pemilik order yang boleh memberi rating
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        // Order harus selesai
        if ($order->status !== 'completed') {
            return redirect()->route('history.index')
                ->with('error', 'Order belum selesai.');
        }

        // Tidak boleh memberi rating dua kali
        if ($order->rating) {
            return redirect()->route('history.index')
                ->with('error', 'Rating sudah diberikan.');
        }

        return view('ratings.create', compact('order'));
    }

    /**
     * Simpan rating
     */
    public function store(Request $request, Order $order)
    {
        // Hanya customer pemilik order
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        // Order harus completed
        if ($order->status !== 'completed') {
            return redirect()->route('history.index')
                ->with('error', 'Order belum selesai.');
        }

        // Cegah rating ganda
        if ($order->rating) {
            return redirect()->route('history.index')
                ->with('error', 'Rating sudah pernah diberikan.');
        }

        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'suggestion' => 'nullable|string|max:500',
        ]);

        // Simpan rating
        Rating::create([
            'order_id'     => $order->id,
            'customer_id'  => Auth::id(),
            'driver_id'    => $order->driver_id,
            'rating'       => $request->rating,
            'suggestion'   => $request->suggestion,
        ]);

        return redirect()->route('history.index')
            ->with('success', 'Terima kasih atas rating yang Anda berikan.');
    }

    /**
     * Menampilkan seluruh rating milik driver
     */
    public function index()
    {
        $ratings = Rating::with(['customer', 'order'])
            ->where('driver_id', Auth::id())
            ->latest()
            ->get();

        $averageRating = round($ratings->avg('rating'), 1);

        return view('ratings.index', compact('ratings', 'averageRating'));
    }
}