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
            <h1 style="
                font-size: 32px;
                margin-bottom: 10px;
            ">
                Halo, {{ auth()->user()->name }} 👋
            </h1>

            <p style="
                font-size: 18px;
                opacity: 0.9;
            ">
                Selamat datang di aplikasi Ride Hailing
            </p>
        </div>

        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        ">

            <a href="{{ route('order.create') }}"
               style="text-decoration:none;">

                <div style="
                    background: white;
                    padding: 25px;
                    border-radius: 18px;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
                    text-align:center;
                    transition: 0.3s;
                ">
                    <h2 style="font-size: 50px;">🚕</h2>

                    <h3>Pesan Ride</h3>

                    <p>Buat order perjalanan baru</p>
                </div>
            </a>

            <a href="{{ route('history.index') }}"
               style="text-decoration:none;">

                <div style="
                    background: white;
                    padding: 25px;
                    border-radius: 18px;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
                    text-align:center;
                ">
                    <h2 style="font-size: 50px;">📜</h2>

                    <h3>History</h3>

                    <p>Lihat riwayat perjalanan</p>
                </div>
            </a>



            <a href="/driver/orders"
               style="text-decoration:none;">

                <div style="
                    background: white;
                    padding: 25px;
                    border-radius: 18px;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
                    text-align:center;
                ">
                    <h2 style="font-size: 50px;">🛵</h2>

                    <h3>Driver Panel</h3>

                    <p>terima pesanan driver</p>
                </div>
            </a>
            
            <a href="{{ route('driver.income') }}">
    <button></button>
    <div style="
                    background: white;
                    padding: 25px;
                    border-radius: 18px;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
                    text-align:center;
                ">
                    <h2 style="font-size: 50px;">🛵</h2>

                    <h3>Driver Panel</h3>

                    <p>Kelola order driver</p>
                </div>
            
</a>
            

        </div>

    </div>
</x-app-layout>