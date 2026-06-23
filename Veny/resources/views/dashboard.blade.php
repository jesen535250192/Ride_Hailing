<x-app-layout>
    <x-slot name="header">
        <h2 style="
            font-size: 28px;
            font-weight: bold;
            color: #111827;
        ">
            🚖 Ride Hailing Dashboard
        </h2>
    </x-slot>

    @php
        $notifCount = \App\Models\Notification::where('user_id', auth()->id())
            ->where('is_read', 0)
            ->count();
    @endphp

    <div style="
        padding: 40px;
        max-width: 1000px;
        margin: auto;
    ">

        <div style="
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            padding: 30px;
            border-radius: 20px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        ">
            <h1 style="font-size: 32px; margin-bottom: 10px;">
                Halo, {{ auth()->user()->name }} 👋
            </h1>

            <p style="font-size: 18px; opacity: 0.9;">
                Selamat datang di aplikasi Ride Hailing
            </p>
        </div>

        <div class="menu-grid">

            <a href="{{ route('order.create') }}" class="menu-link">
                <div class="card-menu">
                    <h2>🛵</h2>
                    <h3>Pesan Ride</h3>
                    <p>Buat order perjalanan baru</p>
                </div>
            </a>

            <a href="{{ route('history.index') }}" class="menu-link">
                <div class="card-menu">
                    <h2>📜</h2>
                    <h3>History</h3>
                    <p>Lihat riwayat perjalanan</p>
                </div>
            </a>

            <a href="{{ route('notifications.index') }}" class="menu-link">
                <div class="card-menu">
                    <h2>🔔</h2>
                    <h3>Notifikasi</h3>
                    <p>{{ $notifCount }} notifikasi baru</p>
                </div>
            </a>

            <a href="{{ route('driver.orders') }}" class="menu-link">
                <div class="card-menu">
                    <h2>🚴</h2>
                    <h3>Driver Panel</h3>
                    <p>Terima pesanan driver</p>
                </div>
            </a>

            <a href="{{ route('driver.income') }}" class="menu-link">
                <div class="card-menu">
                    <h2>💰</h2>
                    <h3>Pendapatan</h3>
                    <p>Lihat rekap pendapatan driver</p>
                </div>
            </a>

            <a href="{{ route('promo.index') }}" class="menu-link">
                <div class="card-menu">
                    <h2>🏷️</h2>
                    <h3>Promo</h3>
                    <p>Lihat promo yang tersedia</p>
                </div>
            </a>

        </div>
    </div>

    <style>
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .menu-link {
            text-decoration: none;
            color: #111827;
        }

        .card-menu {
            background: white;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: 0.3s;
            min-height: 180px;
        }

        .card-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .card-menu h2 {
            font-size: 50px;
            margin: 0 0 10px 0;
        }

        .card-menu h3 {
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .card-menu p {
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</x-app-layout>