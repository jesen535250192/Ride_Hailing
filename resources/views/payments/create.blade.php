<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>

    <style>

        body{
            margin:0;
            font-family:Arial, sans-serif;
            background:#f4f6f8;
        }

        .navbar{
            background:#00aa5b;
            color:white;
            padding:18px 35px;
            font-size:24px;
            font-weight:bold;
        }

        .container{
            display:flex;
            justify-content:center;
            align-items:center;
            padding:40px;
        }

        .form-box{
            width:500px;
            background:white;
            padding:30px;
            border-radius:18px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        h2{
            margin-top:0;
        }

        label{
            display:block;
            margin-top:18px;
            margin-bottom:8px;
            font-weight:bold;
        }

        input,
        select{
            width:100%;
            padding:13px;
            border:1px solid #ccc;
            border-radius:10px;
            font-size:15px;
            box-sizing:border-box;
        }

        input[readonly]{
            background:#f5f5f5;
        }

        .price-card{
            margin-top:25px;
            padding:18px;
            border-radius:15px;
            background:#f1fff7;
            border:1px solid #b7ebcf;
        }

        .price{
            font-size:30px;
            color:#00aa5b;
            font-weight:bold;
        }

        button{
            width:100%;
            margin-top:25px;
            padding:14px;
            border:none;
            border-radius:12px;
            background:#00aa5b;
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
        }

        button:hover{
            background:#00884a;
        }

        .back-btn{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            color:#00aa5b;
            font-weight:bold;
        }

    </style>

</head>

<body>

<div class="navbar">
    Payment
</div>

<div class="container">

    <div class="form-box">

        <h2>Konfirmasi Pembayaran</h2>

        <p>
            Silakan pilih metode pembayaran untuk menyelesaikan pesanan.
        </p>

        <form action="{{ route('payments.store') }}" method="POST">

            @csrf

            <input
                type="hidden"
                name="order_id"
                value="{{ $order->id }}">

            <label>
                Order ID
            </label>

            <input
                value="#{{ $order->id }}"
                readonly>

            <label>
                Customer
            </label>

            <input
                value="{{ $order->user->name }}"
                readonly>

            <label>
                Pickup
            </label>

            <input
                value="{{ $order->pickup_location }}"
                readonly>

            <label>
                Destination
            </label>

            <input
                value="{{ $order->destination }}"
                readonly>

            <label>
                Payment Method
            </label>

            <select name="payment_method">

                <option value="Cash">
                    Cash
                </option>

                <option value="QRIS">
                    QRIS
                </option>

                <option value="Transfer">
                    Transfer
                </option>

            </select>

            <div class="price-card">

                <p>Total Pembayaran</p>

                <div class="price">

                    Rp {{ number_format($order->price,0,',','.') }}

                </div>

            </div>

            <button type="submit">

                💳 Bayar Sekarang

            </button>

        </form>

        <a href="{{ route('history.index') }}"
           class="back-btn">

            ← Kembali ke History

        </a>

    </div>

</div>

</body>
</html>