<!DOCTYPE html>
<html>
<head>
    <title>History Order</title>

    <style>

        body{
            margin:0;
            font-family:Arial;
            background:#f4f6f8;
        }

        .navbar{
            background:#00aa5b;
            color:white;
            padding:18px 30px;
            font-size:24px;
            font-weight:bold;
        }

        .container{
            padding:30px;
        }

        .top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .back-btn{
            background:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            color:#00aa5b;
            font-weight:bold;
            border:2px solid #00aa5b;
        }

        .back-btn:hover{
            background:#00aa5b;
            color:white;
        }

        .card{
            background:white;
            border-radius:18px;
            padding:22px;
            margin-bottom:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.08);
        }

        .route{
            margin-top:15px;
            padding-left:15px;
            border-left:4px solid #00aa5b;
        }

        .label{
            color:gray;
            font-size:14px;
        }

        .value{
            font-size:17px;
            margin-bottom:15px;
        }

        .price{
            font-size:28px;
            color:#00aa5b;
            font-weight:bold;
        }

        .status{
            display:inline-block;
            padding:8px 15px;
            border-radius:20px;
            color:white;
            font-size:14px;
            font-weight:bold;
        }

        .pending{
            background:orange;
        }

        .accepted{
            background:#00aa5b;
        }

        .on_the_way{
            background:#6f42c1;
        }

        .completed{
            background:#007bff;
        }

        .cancelled{
            background:red;
        }

        .empty{
            text-align:center;
            padding:80px;
            color:gray;
            font-size:20px;
        }

        .chat-btn{
            background:#00aa5b;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .chat-btn:hover{
            background:#00884a;
        }

        .pay-btn{
            background:#007bff;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .pay-btn:hover{
            background:#0056b3;
        }

        .paid-btn{
            background:#28a745;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            font-weight:bold;
        }

        /* ==========================
           Rating
        ========================== */

        .rating-btn{
            background:#ffc107;
            color:black;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .rating-btn:hover{
            background:#e0a800;
        }

        .rated-btn{
            background:#17a2b8;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            font-weight:bold;
        }

    </style>
</head>

<body>

<div class="navbar">
    History Order
</div>

<div class="container">

    <div class="top">

        <h2>Riwayat Perjalanan</h2>

        <a href="/dashboard" class="back-btn">
            ← Dashboard
        </a>

    </div>

    @forelse($orders as $order)

        <div class="card">

            <div style="display:flex;justify-content:space-between;align-items:center;">

                <div>
                    <div class="label">Order ID</div>

                    <div class="value">
                        #{{ $order->id }}
                    </div>
                </div>

                <div>
                    <span class="status {{ $order->status }}">
                        {{ strtoupper($order->status) }}
                    </span>
                </div>

            </div>

            <div class="route">

                <div class="label">
                    Lokasi Jemput
                </div>

                <div class="value">
                    {{ $order->pickup_location }}
                </div>

                <div class="label">
                    Tujuan
                </div>

                <div class="value">
                    {{ $order->destination }}
                </div>

            </div>

            <div style="display:flex;justify-content:space-between;margin-top:20px;">

                <div>
                    <div class="label">Jarak</div>

                    <div class="value">
                        {{ $order->distance ?? '-' }} KM
                    </div>
                </div>

                <div>
                    <div class="label">Harga</div>

                    <div class="price">
                        Rp {{ number_format($order->price,0,',','.') }}
                    </div>
                </div>

            </div>

            <div style="margin-top:20px;display:flex;gap:10px;flex-wrap:wrap;">

                {{-- CHAT --}}
                <a href="{{ route('chat.index', $order->id) }}"
                    class="chat-btn">
                    💬 Chat Driver
                </a>

                {{-- PAYMENT --}}
                @if(!$order->payment)

                    <a href="{{ route('payments.create',['order'=>$order->id]) }}"
                        class="pay-btn">

                        💳 Pay

                    </a>

                @else

                    <span class="paid-btn">

                        ✅ Paid

                    </span>

                @endif

                {{-- RATING --}}
                @if($order->status == 'completed')

                    @if(!$order->rating)

                        <a href="{{ route('ratings.create',$order->id) }}"
                            class="rating-btn">

                            ⭐ Beri Rating

                        </a>

                    @else

                        <span class="rated-btn">

                            ⭐ {{ $order->rating->rating }}/5

                        </span>

                    @endif

                @endif

            </div>

        </div>

    @empty

        <div class="empty">

            Belum ada history order

        </div>

    @endforelse

</div>

</body>
</html>