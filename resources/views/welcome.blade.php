<!DOCTYPE html>
<html>
<head>

    <title>Ride Hailing</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            background:#f4f6f8;
        }

        .navbar{

            background:#00aa5b;

            color:white;

            padding:18px 50px;

            display:flex;

            justify-content:space-between;

            align-items:center;
        }

        .logo{

            font-size:28px;

            font-weight:bold;

        }

        .menu{

            display:flex;

            gap:20px;

        }

        .menu a{

            color:white;

            text-decoration:none;

            font-weight:bold;

        }

        .hero{

            max-width:1200px;

            margin:auto;

            padding:80px 40px;

            display:flex;

            justify-content:space-between;

            align-items:center;

        }

        .hero-text{

            width:50%;

        }

        .hero-text h1{

            font-size:52px;

            color:#00aa5b;

            margin-bottom:20px;

        }

        .hero-text p{

            color:#666;

            font-size:20px;

            line-height:32px;

            margin-bottom:35px;

        }

        .btn{

            display:inline-block;

            padding:14px 28px;

            background:#00aa5b;

            color:white;

            text-decoration:none;

            border-radius:10px;

            margin-right:15px;

            font-weight:bold;

        }

        .btn:hover{

            background:#00884a;

        }

        .hero-image{

            font-size:180px;

        }

        .feature{

            background:white;

            padding:70px;

        }

        .feature h2{

            text-align:center;

            color:#00aa5b;

            margin-bottom:40px;

            font-size:36px;

        }

        .cards{

            display:grid;

            grid-template-columns:repeat(3,1fr);

            gap:25px;

            max-width:1200px;

            margin:auto;

        }

        .card{

            background:#f8f8f8;

            padding:35px;

            border-radius:18px;

            text-align:center;

            box-shadow:0 5px 15px rgba(0,0,0,.08);

        }

        .card h3{

            margin:20px 0;

            color:#00aa5b;

        }

        .footer{

            background:#00aa5b;

            color:white;

            text-align:center;

            padding:25px;

            margin-top:60px;

        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">

        🚖 Ride Hailing

    </div>

    <div class="menu">

        <a href="{{ route('login') }}">

            Login

        </a>

        <a href="{{ route('register') }}">

            Register

        </a>

    </div>

</div>

<div class="hero">

    <div class="hero-text">

        <h1>

            Ride Hailing

        </h1>

        <p>

            Platform transportasi online yang cepat,
            aman, dan mudah digunakan.

            Customer dapat memesan perjalanan,
            Driver dapat menerima order secara realtime.

        </p>

        <a href="{{ route('login') }}" class="btn">

            Login

        </a>

        <a href="{{ route('register') }}" class="btn">

            Register

        </a>

    </div>

    <div class="hero-image">

        🚕

    </div>

</div>

<div class="feature">

    <h2>

        Kenapa Memilih Ride Hailing?

    </h2>

    <div class="cards">

        <div class="card">

            <div style="font-size:70px;">

                🚕

            </div>

            <h3>

                Booking Mudah

            </h3>

            <p>

                Pesan perjalanan hanya dalam beberapa klik.

            </p>

        </div>

        <div class="card">

            <div style="font-size:70px;">

                💬

            </div>

            <h3>

                Chat Driver

            </h3>

            <p>

                Komunikasi langsung dengan driver.

            </p>

        </div>

        <div class="card">

            <div style="font-size:70px;">

                💳

            </div>

            <h3>

                Payment

            </h3>

            <p>

                Pembayaran cepat dan aman.

            </p>

        </div>

    </div>

</div>

<div class="footer">

    © 2026 Ride Hailing

</div>

</body>
</html>