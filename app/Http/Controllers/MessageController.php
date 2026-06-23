<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Validasi apakah user boleh mengakses chat order ini
     */
    private function authorizeOrder(Order $order)
    {
        $user = auth()->user();

        // Customer hanya boleh melihat order miliknya
        if ($user->role == 'customer' && $order->user_id == $user->id) {
            return;
        }

        // Driver hanya boleh melihat order yang dia ambil
        if ($user->role == 'driver' && $order->driver_id == $user->id) {
            return;
        }

        abort(403, 'Anda tidak memiliki akses ke chat ini.');
    }

    public function index(Order $order)
    {
        $this->authorizeOrder($order);

        $messages = Message::where('order_id', $order->id)
            ->oldest()
            ->get();

        return view('chat.index', compact('order', 'messages'));
    }

    public function store(Request $request, Order $order)
    {
        $this->authorizeOrder($order);

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'order_id' => $order->id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->route('chat.index', $order->id);
    }
}