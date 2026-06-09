<!DOCTYPE html>
<html>
<head>
    <title>Order Driver Saya</title>

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
            color:white;
            padding:12px 18px;
            text-decoration:none;
            border-radius:10px;
            display:inline-block;
            margin-top:10px;
            margin-right:10px;
        }

        .otw{
            background:#ff9800;
        }

        .done{
            background:#28a745;
        }

        .chat{
            background:#007bff;
        }

        .back{
            background:#6c757d;
        }

    </style>

</head>
<body>

<a href="/dashboard" class="btn back">
    Dashboard
</a>

<h1>Order Driver Saya</h1>

@foreach($orders as $order)

<div class="card">

    <h3>Order #{{ $order->id }}</h3>

    <p>
        <b>Customer:</b>
        {{ $order->user->name ?? '-' }}
    </p>

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
        {{ strtoupper($order->status) }}
    </p>

    <p>
        <b>Harga:</b>
        Rp {{ number_format($order->price,0,',','.') }}
    </p>

    <a class="btn chat"
       href="{{ route('chat.index', $order->id) }}">
        Chat Customer
    </a>

    @if($order->status == 'accepted')

        <a class="btn otw"
           href="{{ route('driver.order.status', [$order->id, 'on_the_way']) }}">
            OTW
        </a>

    @endif

    @if($order->status == 'on_the_way')

        <a class="btn done"
           href="{{ route('driver.order.status', [$order->id, 'completed']) }}">
            Selesai
        </a>

    @endif

</div>

@endforeach

</body>
</html>