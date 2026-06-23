<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #f6f6f6;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }
        .topbar {
            background: #000;
            color: white;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .topbar a {
            color: white;
            text-decoration: none;
            font-size: 22px;
        }
        .topbar h1 { font-size: 18px; font-weight: 600; }
        .container { max-width: 600px; margin: 32px auto; padding: 0 16px; }
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #999;
        }
        .empty-state .icon { font-size: 56px; margin-bottom: 16px; }
        .empty-state p { font-size: 16px; }
        .promo-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .promo-left { display: flex; align-items: center; gap: 16px; }
        .promo-icon {
            background: #000;
            color: white;
            border-radius: 10px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }
        .promo-info h3 {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #111;
        }
        .promo-info p {
            font-size: 13px;
            color: #888;
            margin-top: 2px;
        }
        .promo-diskon {
            background: #000;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 15px;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="topbar">
    <a href="/dashboard">&#8592;</a>
    <h1>Promo</h1>
</div>

<div class="container">
    @forelse($promos as $promo)
        <div class="promo-card">
            <div class="promo-left">
                <div class="promo-icon">🏷️</div>
                <div class="promo-info">
                    <h3>{{ $promo->kode }}</h3>
                    <p>Gunakan kode ini saat checkout</p>
                </div>
            </div>
            <div class="promo-diskon">{{ $promo->diskon }}% OFF</div>
        </div>
    @empty
        <div class="empty-state">
            <div class="icon">🎟️</div>
            <p>Belum ada promo tersedia</p>
        </div>
    @endforelse
</div>

</body>
</html>