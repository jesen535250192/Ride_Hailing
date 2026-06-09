<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Order $order)
    {
        $messages = Message::where('order_id', $order->id)
            ->oldest()
            ->get();

        return view('chat.index', compact('order', 'messages'));
    }

    public function store(Request $request, Order $order)
    {
        $request->validate([
            'message' => 'required',
        ]);

        Message::create([
            'order_id' => $order->id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->route('chat.index', $order->id);
    }
}