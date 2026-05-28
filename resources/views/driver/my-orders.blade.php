<!DOCTYPE html>
<html>
<head>
    <title>Order Saya</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f6f8;
            padding:30px;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:15px;
            margin-bottom:20px;
            box-shadow:0 5px 10px rgba(0,0,0,0.08);
        }

        .btn{
            background:#007bff;
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

<h1>Order Driver Saya</h1>

@foreach($orders as $order)

<div class="card">

    <h3>Order #{{ $order->id }}</h3>

    <p>
        <b>Jemput:</b>
        {{ $order->pickup_location }}
    </p>

    <p>
        <b>Tujuan:</b>
        {{ $order->destination }}
    </p>

    <p>
        <b>Status:</b>
        {{ $order->status }}
    </p>

    <p>
        <b>Harga:</b>
        Rp {{ number_format($order->price,0,',','.') }}
    </p>

    @if($order->status == 'accepted')

        <a class="btn"
           href="{{ route('driver.order.status', [$order->id, 'completed']) }}">

            Selesaikan Order

        </a>

    @endif

</div>

@endforeach

</body>
</html>