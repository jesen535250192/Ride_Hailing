<!DOCTYPE html>
<html>
<head>
    <title>Payment Detail</title>

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
            max-width:900px;
            margin:auto;
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
            padding:25px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .route{
            margin-top:20px;
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
            font-size:30px;
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

        .info-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:20px;
            margin-top:20px;
        }

    </style>

</head>

<body>

<div class="navbar">
    Payment Detail
</div>

<div class="container">

    <div class="top">

        <h2>Detail Pembayaran</h2>

        <a href="{{ route('payments.index') }}"
           class="back-btn">

            ← Payment List

        </a>

    </div>

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
                Pickup Location
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

        </div>

        <div class="info-grid">

            <div>

                <div class="label">
                    Order ID
                </div>

                <div class="value">
                    #{{ $payment->order->id }}
                </div>

            </div>

            <div>

                <div class="label">
                    Payment Method
                </div>

                <div class="value">
                    {{ $payment->payment_method }}
                </div>

            </div>

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
                    Total Payment
                </div>

                <div class="price">
                    Rp {{ number_format($payment->amount,0,',','.') }}
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>