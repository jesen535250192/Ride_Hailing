<h2>Pesanan Saya</h2>

<a href="/dashboard">
    <button>Kembali ke Dashboard</button>
</a>

<a href="{{ route('driver.orders') }}">
    <button>Order Baru</button>
</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Customer</th>
        <th>Jemput</th>
        <th>Tujuan</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach ($orders as $order)
    <tr>
        <td>{{ $order->user->name ?? '-' }}</td>
        <td>{{ $order->pickup_location }}</td>
        <td>{{ $order->destination }}</td>
        <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
        <td>{{ $order->status }}</td>

        <td>
            @if($order->status == 'accepted')
                <a href="{{ route('driver.order.status', [$order->id, 'on_the_way']) }}">
                    <button>OTW</button>
                </a>
            @endif

            @if($order->status == 'on_the_way')
                <a href="{{ route('driver.order.status', [$order->id, 'completed']) }}">
                    <button>Selesai</button>
                </a>
            @endif
        </td>
    </tr>
    @endforeach
</table>