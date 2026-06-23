<!DOCTYPE html>
<html>
<head>
    <title>Driver Income</title>

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
            max-width:1000px;
            margin:auto;
        }

        .top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .button-group{
            display:flex;
            gap:10px;
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

        .summary-card{
            background:white;
            border-radius:18px;
            padding:25px;
            margin-bottom:25px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .total-income{
            font-size:34px;
            font-weight:bold;
            color:#00aa5b;
            margin-top:10px;
        }

        .card{
            background:white;
            border-radius:18px;
            padding:22px;
            margin-bottom:20px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
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
            background:#007bff;
            color:white;
            font-size:14px;
            font-weight:bold;
        }

        .empty{
            text-align:center;
            padding:70px;
            background:white;
            border-radius:18px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
            color:gray;
            font-size:20px;
        }

    </style>

</head>

<body>

<div class="navbar">
    Driver Income
</div>

<div class="container">

    <div class="top">

        <h2>Rekap Pendapatan Driver</h2>

        <div class="button-group">

            <a href="/dashboard"
               class="back-btn">
                ← Dashboard
            </a>

            <a href="{{ route('driver.my.orders') }}"
               class="back-btn">
                📦 Pesanan Saya
            </a>

        </div>

    </div>

    <div class="summary-card">

        <div class="label">
            Total Pendapatan
        </div>

        <div class="total-income">
            Rp {{ number_format($totalIncome,0,',','.') }}
        </div>

    </div>

    @forelse($orders as $order)

        <div class="card">

            <div style="display:flex;justify-content:space-between;align-items:center;">

                <div>

                    <div class="label">
                        Customer
                    </div>

                    <div class="value">
                        {{ $order->user->name ?? '-' }}
                    </div>

                </div>

                <div>

                    <span class="status">
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

                    <div class="label">
                        Tanggal
                    </div>

                    <div class="value">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </div>

                </div>

                <div>

                    <div class="label">
                        Pendapatan
                    </div>

                    <div class="price">
                        Rp {{ number_format($order->price,0,',','.') }}
                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="empty">

            Belum ada pendapatan.

        </div>

    @endforelse

</div>

</body>
</html>