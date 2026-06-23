<!DOCTYPE html>
<html>
<head>
    <title>Payment History</title>

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

        .paid{
            background:#00aa5b;
        }

        .pending{
            background:orange;
        }

        .empty{
            text-align:center;
            padding:80px;
            color:gray;
            font-size:20px;
        }

        .detail-btn{
            background:#00aa5b;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .detail-btn:hover{
            background:#00884a;
        }

    </style>

</head>

<body>

<div class="navbar">
    Payment
</div>

<div class="container">

    <div class="top">

        <h2>Riwayat Pembayaran</h2>

        <a href="/dashboard" class="back-btn">
            ← Dashboard
        </a>

    </div>

    @if(session('success'))

        <div style="
            background:#d4edda;
            color:#155724;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        ">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div style="
            background:#f8d7da;
            color:#721c24;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        ">
            {{ session('error') }}
        </div>

    @endif

    @forelse($payments as $payment)

        <div class="card">

            <div style="display:flex;justify-content:space-between;align-items:center;">

                <div>

                    <div class="label">
                        Payment ID
                    </div>

                    <div class="value">
                        #{{ $payment->id }}
                    </div>

                </div>

                <div>

                    <span class="status {{ strtolower($payment->status) }}">
                        {{ strtoupper($payment->status) }}
                    </span>

                </div>

            </div>

            <div class="route">

                <div class="label">
                    Customer
                </div>

                <div class="value">
                    {{ $payment->order->user->name }}
                </div>

                <div class="label">
                    Pickup
                </div>

                <div class="value">
                    {{ $payment->order->pickup_location }}
                </div>

                <div class="label">
                    Destination
                </div>

                <div class="value">
                    {{ $payment->order->destination }}
                </div>

                <div class="label">
                    Payment Method
                </div>

                <div class="value">
                    {{ $payment->payment_method }}
                </div>

            </div>

            <div style="display:flex;justify-content:space-between;margin-top:20px;">

                <div>

                    <div class="label">
                        Transaction Date
                    </div>

                    <div class="value">
                        {{ \Carbon\Carbon::parse($payment->transaction_date)->format('d M Y H:i') }}
                    </div>

                </div>

                <div>

                    <div class="label">
                        Amount
                    </div>

                    <div class="price">
                        Rp {{ number_format($payment->amount,0,',','.') }}
                    </div>

                </div>

            </div>

            <div style="margin-top:20px;">

                <a href="{{ route('payments.show',$payment->id) }}"
                   class="detail-btn">

                    📄 Detail

                </a>

            </div>

        </div>

    @empty

        <div class="empty">

            Belum ada pembayaran.

        </div>

    @endforelse

</div>

</body>
</html>