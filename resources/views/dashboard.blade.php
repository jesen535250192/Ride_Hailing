<!DOCTYPE html>
<html>
<head>
    <title>Ride Hailing Dashboard</title>

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

            display:flex;
            justify-content:space-between;
            align-items:center;

            font-size:24px;
            font-weight:bold;
        }

        .navbar-right{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .user-name{
            font-size:16px;
            font-weight:bold;
        }

        .logout-btn{
            background:white;
            color:#00aa5b;
            border:none;
            padding:8px 16px;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
            transition:.3s;
        }

        .logout-btn:hover{
            background:#f0f0f0;
        }

        .container{
            max-width:1100px;
            margin:auto;
            padding:30px;
        }

        .welcome-card{
            background:white;
            border-radius:18px;
            padding:30px;
            margin-bottom:30px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
            border-left:6px solid #00aa5b;
        }

        .welcome-card h1{
            margin:0;
            font-size:32px;
            color:#222;
        }

        .welcome-card p{
            margin-top:10px;
            color:#666;
            font-size:17px;
        }

        .menu-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
        }

        .menu-card{
            background:white;
            border-radius:18px;
            padding:30px 20px;
            text-align:center;
            text-decoration:none;
            color:#222;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
            transition:.3s;
        }

        .menu-card:hover{
            transform:translateY(-5px);
            box-shadow:0 8px 20px rgba(0,0,0,.15);
        }

        .menu-card .icon{
            font-size:55px;
            margin-bottom:15px;
        }

        .menu-card h3{
            margin:0;
            color:#00aa5b;
            font-size:22px;
        }

        .menu-card p{
            margin-top:10px;
            color:#666;
            font-size:15px;
        }

    </style>

</head>

<body>

<div class="navbar">

    <div>
        🚖 Ride Hailing Dashboard
    </div>

    <div class="navbar-right">

        <span class="user-name">
            👤 {{ auth()->user()->name }}
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-btn">
                Logout
            </button>

        </form>

    </div>

</div>

<div class="container">

    <div class="welcome-card">

        <h1>
            Halo, {{ auth()->user()->name }} 👋
        </h1>

        <p>
            Selamat datang di aplikasi Ride Hailing.
            Silakan pilih menu di bawah untuk mulai menggunakan aplikasi.
        </p>

    </div>

    <div class="menu-grid">

        <a href="{{ route('order.create') }}" class="menu-card">

            <div class="icon">
                🚕
            </div>

            <h3>Pesan Ride</h3>

            <p>
                Buat order perjalanan baru.
            </p>

        </a>

        <a href="{{ route('history.index') }}" class="menu-card">

            <div class="icon">
                📜
            </div>

            <h3>History</h3>

            <p>
                Lihat riwayat perjalanan.
            </p>

        </a>

        <a href="{{ route('payments.index') }}" class="menu-card">

            <div class="icon">
                💳
            </div>

            <h3>Payment</h3>

            <p>
                Lihat dan kelola pembayaran.
            </p>

        </a>

        <a href="/driver/orders" class="menu-card">

            <div class="icon">
                🛵
            </div>

            <h3>Driver Panel</h3>

            <p>
                Terima dan kelola pesanan driver.
            </p>

        </a>

        <a href="{{ route('driver.income') }}" class="menu-card">

            <div class="icon">
                💰
            </div>

            <h3>Driver Income</h3>

            <p>
                Lihat total pendapatan driver.
            </p>

        </a>

    </div>

</div>

</body>
</html>