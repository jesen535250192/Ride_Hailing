<h2>Halaman Driver - Order Baru</h2>

<a href="/dashboard">
    <button>Kembali ke Dashboard</button>
</a>

<a href="{{ route('driver.my.orders') }}">
    <button>Pesanan Saya</button>
</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Customer</th>
        <th>Jemput</th>
        <th>Tujuan</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi Driver</th>
    </tr>

    @foreach ($orders as $order)
    <tr>
        <td>{{ $order->user->name ?? '-' }}</td>

        <td>{{ $order->pickup_location }}</td>

        <td>{{ $order->destination }}</td>

        <td>
            Rp {{ number_format($order->price, 0, ',', '.') }}
        </td>

        <td>{{ $order->status }}</td>

        <td>
            <a href="{{ route('driver.order.status', [$order->id, 'accepted']) }}">
                <button>Terima Pesanan</button>
            </a>
        </td>
    </tr>
    @endforeach
</table>