<!DOCTYPE html>
<html>
<head>
    <title>Buat Order</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        .navbar {
            background: #00aa5b;
            color: white;
            padding: 18px 35px;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            display: grid;
            grid-template-columns: 380px 1fr;
            height: calc(100vh - 64px);
        }

        .form-box {
            background: white;
            padding: 28px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.08);
            z-index: 10;
        }

        input {
            width: 100%;
            padding: 13px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
        }

        .price-card {
            margin-top: 25px;
            padding: 18px;
            border-radius: 15px;
            background: #f1fff7;
            border: 1px solid #b7ebcf;
        }

        .price {
            font-size: 28px;
            color: #00aa5b;
            font-weight: bold;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 15px;
            border: none;
            border-radius: 12px;
            background: #00aa5b;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #008f4c;
        }

        #map {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

<div class="navbar">
    Order Jemput
</div>

<div class="container">

    <div class="form-box">
        <h2>Buat Order</h2>
        <p>Ketik lokasi atau klik map untuk pilih lokasi jemput dan tujuan.</p>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <input type="text" id="pickup_location" name="pickup_location" placeholder="Masukkan lokasi jemput" required>

            <input type="text" id="destination" name="destination" placeholder="Masukkan tujuan" required>

            <input type="hidden" id="pickup_lat" name="pickup_lat">
            <input type="hidden" id="pickup_lng" name="pickup_lng">

            <input type="hidden" id="destination_lat" name="destination_lat">
            <input type="hidden" id="destination_lng" name="destination_lng">

            <input type="hidden" id="distance" name="distance">
            <input type="hidden" id="price" name="price">

            <div class="price-card">
                <p>Jarak: <b><span id="distanceText">0</span> km</b></p>
                <p>Tarif: <b>Rp10.000 / km</b></p>
                <p>Estimasi Harga:</p>
                <div class="price">Rp <span id="priceText">0</span></div>
            </div>

            <button type="button" onclick="searchLocationAndCalculate()">
                Cari & Hitung Jarak
            </button>

            <button type="button" onclick="getMyLocation()">
                Ambil Lokasi Saya
            </button>

            <button type="submit">
                Pesan Sekarang
            </button>
        </form>
    </div>

    <div id="map"></div>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let map = L.map('map').setView([-6.1754, 106.8272], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'OpenStreetMap'
    }).addTo(map);

    let pickupMarker = null;
    let destMarker = null;
    let routeLine = null;
    let step = 1;

    const tariffPerKm = 10000;

    map.on('click', async function(e) {
        let lat = e.latlng.lat;
        let lng = e.latlng.lng;

        let address = await getAddress(lat, lng);

        if(step === 1) {
            if(pickupMarker) {
                map.removeLayer(pickupMarker);
            }

            pickupMarker = L.marker([lat, lng])
                .addTo(map)
                .bindPopup("Lokasi Jemput")
                .openPopup();

            document.getElementById('pickup_lat').value = lat;
            document.getElementById('pickup_lng').value = lng;
            document.getElementById('pickup_location').value = address;

            step = 2;
        } else {
            if(destMarker) {
                map.removeLayer(destMarker);
            }

            destMarker = L.marker([lat, lng])
                .addTo(map)
                .bindPopup("Tujuan")
                .openPopup();

            document.getElementById('destination_lat').value = lat;
            document.getElementById('destination_lng').value = lng;
            document.getElementById('destination').value = address;

            calculateDistance();

            step = 1;
        }
    });

    async function getAddress(lat, lng) {
        try {
            let response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`
            );

            let data = await response.json();

            if(data.address) {
                return (
                    data.address.road ||
                    data.address.suburb ||
                    data.address.village ||
                    data.address.city ||
                    data.display_name
                );
            }

            return data.display_name;
        } catch(error) {
            return "Lokasi Tidak Diketahui";
        }
    }

    async function searchCoordinate(address) {
        let response = await fetch(
            'https://nominatim.openstreetmap.org/search?format=json&q='
            + encodeURIComponent(address)
        );

        let data = await response.json();

        if(data.length === 0) {
            alert('Lokasi tidak ditemukan: ' + address);
            return null;
        }

        return {
            lat: parseFloat(data[0].lat),
            lng: parseFloat(data[0].lon)
        };
    }

    async function searchLocationAndCalculate() {
        let pickupText = document.getElementById('pickup_location').value;
        let destinationText = document.getElementById('destination').value;

        if(!pickupText || !destinationText) {
            alert('Isi lokasi jemput dan tujuan dulu');
            return;
        }

        let pickupCoord = await searchCoordinate(pickupText);
        let destCoord = await searchCoordinate(destinationText);

        if(!pickupCoord || !destCoord) {
            return;
        }

        document.getElementById('pickup_lat').value = pickupCoord.lat;
        document.getElementById('pickup_lng').value = pickupCoord.lng;

        document.getElementById('destination_lat').value = destCoord.lat;
        document.getElementById('destination_lng').value = destCoord.lng;

        if(pickupMarker) {
            map.removeLayer(pickupMarker);
        }

        if(destMarker) {
            map.removeLayer(destMarker);
        }

        pickupMarker = L.marker([pickupCoord.lat, pickupCoord.lng])
            .addTo(map)
            .bindPopup('Lokasi Jemput')
            .openPopup();

        destMarker = L.marker([destCoord.lat, destCoord.lng])
            .addTo(map)
            .bindPopup('Tujuan');

        calculateDistance();
    }

    function calculateDistance() {
        let pickupLat = parseFloat(document.getElementById('pickup_lat').value);
        let pickupLng = parseFloat(document.getElementById('pickup_lng').value);

        let destLat = parseFloat(document.getElementById('destination_lat').value);
        let destLng = parseFloat(document.getElementById('destination_lng').value);

        if(isNaN(pickupLat) || isNaN(pickupLng) || isNaN(destLat) || isNaN(destLng)) {
            return;
        }

        let distance = getDistanceFromLatLonInKm(
            pickupLat,
            pickupLng,
            destLat,
            destLng
        );

        let price = Math.ceil(distance * tariffPerKm);

        document.getElementById('distance').value = distance.toFixed(2);
        document.getElementById('price').value = price;

        document.getElementById('distanceText').innerText = distance.toFixed(2);
        document.getElementById('priceText').innerText = price.toLocaleString('id-ID');

        if(routeLine) {
            map.removeLayer(routeLine);
        }

        routeLine = L.polyline([
            [pickupLat, pickupLng],
            [destLat, destLng]
        ], {
            color: '#00aa5b',
            weight: 5
        }).addTo(map);

        map.fitBounds(routeLine.getBounds());
    }

    function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
        let R = 6371;

        let dLat = deg2rad(lat2 - lat1);
        let dLon = deg2rad(lon2 - lon1);

        let a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) *
            Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) *
            Math.sin(dLon / 2);

        let c =
            2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        return R * c;
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180);
    }

    function getMyLocation() {
    if (!navigator.geolocation) {
        alert("Browser tidak mendukung lokasi");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        async function(position) {
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;
            let accuracy = position.coords.accuracy;

            if (accuracy > 1000) {
                alert("Lokasi kurang akurat. Coba aktifkan GPS / WiFi, atau pilih lokasi manual di map.");
            }

            map.setView([lat, lng], 16);

            let address = await getAddress(lat, lng);

            if (pickupMarker) {
                map.removeLayer(pickupMarker);
            }

            pickupMarker = L.marker([lat, lng])
                .addTo(map)
                .bindPopup("Lokasi Saya<br>Akurasi: " + Math.round(accuracy) + " meter")
                .openPopup();

            document.getElementById('pickup_lat').value = lat;
            document.getElementById('pickup_lng').value = lng;
            document.getElementById('pickup_location').value = address;

            step = 2;
        },
        function(error) {
            alert("Gagal mengambil lokasi. Izinkan akses lokasi di browser.");
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}
</script>

</body>
</html>