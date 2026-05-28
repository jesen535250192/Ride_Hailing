<h2>Rekap Pendapatan Driver</h2>

<a href="/dashboard">
    <button>Kembali ke Dashboard</button>
</a>

<a href="{{ route('driver.my.orders') }}">
    <button>Pesanan Saya</button>
</a>

<br><br>

<h3>Total Pendapatan: Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>Customer</th>
        <th>Jemput</th>
        <th>Tujuan</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>

    @foreach ($orders as $order)
    <tr>
        <td>{{ $order->user->name ?? '-' }}</td>
        <td>{{ $order->pickup_location }}</td>
        <td>{{ $order->destination }}</td>
        <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
        <td>{{ $order->status }}</td>
        <td>{{ $order->created_at }}</td>
    </tr>
    @endforeach
</table>