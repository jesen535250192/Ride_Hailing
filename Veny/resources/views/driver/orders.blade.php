<!DOCTYPE html>
<html>
<head>
    <title>Order Masuk</title>

    <style>
        body{
            font-family:Arial;
            background:#f4f6f8;
            padding:30px;
        }

        .back-btn{
            display:inline-block;
            margin-bottom:20px;
            background:#00aa5b;
            color:white;
            padding:12px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:15px;
            margin-bottom:20px;
            box-shadow:0 5px 10px rgba(0,0,0,0.08);
        }

        .btn{
            background:#00aa5b;
            color:white;
            padding:12px 18px;
            text-decoration:none;
            border-radius:10px;
            display:inline-block;
            margin-top:10px;
        }
    </style>
</head>

<body>

<a href="/dashboard" class="back-btn">← Kembali ke Dashboard</a>

<h1>Order Masuk Driver</h1>

@forelse($orders as $order)

    <div class="card">
        <h3>Order #{{ $order->id }}</h3>

        <p><b>Jemput:</b> {{ $order->pickup_location }}</p>
        <p><b>Tujuan:</b> {{ $order->destination }}</p>
        <p><b>Jarak:</b> {{ $order->distance }} KM</p>
        <p><b>Harga:</b> Rp {{ number_format($order->price,0,',','.') }}</p>

        <a class="btn" href="{{ route('driver.order.status', [$order->id, 'accepted']) }}">
            Ambil Order
        </a>
    </div>

@empty

    <p>Belum ada order masuk.</p>

@endforelse

</body>
</html>