<h2>Buat Order</h2>

<form method="POST" action="{{ route('order.store') }}">
    @csrf

    <label>Lokasi Jemput</label><br>
    <input type="text" name="pickup_location" required><br><br>

    <label>Tujuan</label><br>
    <input type="text" name="destination" required><br><br>

    <input type="hidden" name="pickup_lat" id="pickup_lat">
    <input type="hidden" name="pickup_lng" id="pickup_lng">

    <button type="button" onclick="getLocation()">Ambil Lokasi Saya</button>
    <button type="submit">Pesan Sekarang</button>
</form>

<script>
function getLocation() {
    navigator.geolocation.getCurrentPosition(function(position) {
        document.getElementById('pickup_lat').value = position.coords.latitude;
        document.getElementById('pickup_lng').value = position.coords.longitude;
        alert('Lokasi berhasil diambil');
    });
}
</script>