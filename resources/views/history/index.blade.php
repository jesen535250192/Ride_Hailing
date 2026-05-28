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
                        {{ $order->distance ?? 0 }} KM
                    </div>
                </div>

                <div>
                    <div class="label">Harga</div>

                    <div class="price">
                        Rp {{ number_format($order->price,0,',','.') }}
                    </div>
                </div>

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