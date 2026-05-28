<h2>History Order</h2>

<a href="/dashboard">
    <button>Kembali ke Dashboard</button>
</a>

<br><br>

<a href="{{ route('order.create') }}">
    <button>Buat Order Baru</button>
</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Jemput</th>
        <th>Tujuan</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>

    @foreach ($orders as $order)
    <tr>
        <td>{{ $order->pickup_location }}</td>
        <td>{{ $order->destination }}</td>
        <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
        <td>{{ $order->status }}</td>
        <td>{{ $order->created_at }}</td>
    </tr>
    @endforeach
</table>