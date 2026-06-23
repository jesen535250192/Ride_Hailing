<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
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
        .notif-card {
            background: white;
            border-radius: 12px;
            padding: 18px 20px;
            margin-bottom: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            display: flex;
            gap: 16px;
            align-items: flex-start;
            border-left: 4px solid #000;
        }
        .notif-icon {
            font-size: 28px;
            margin-top: 2px;
        }
        .notif-content h3 {
            font-size: 15px;
            font-weight: 600;
            color: #111;
            margin-bottom: 4px;
        }
        .notif-content p {
            font-size: 14px;
            color: #555;
            margin-bottom: 6px;
        }
        .notif-content small {
            font-size: 12px;
            color: #aaa;
        }
        .badge-unread {
            background: #000;
            color: white;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 20px;
            margin-left: 8px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="topbar">
    <a href="/dashboard">&#8592;</a>
    <h1>Notifikasi</h1>
</div>

<div class="container">
    @forelse($notifications as $notif)
        <div class="notif-card">
            <div class="notif-icon">🔔</div>
            <div class="notif-content">
                <h3>
                    {{ $notif->title }}
                    @if(!$notif->is_read)
                        <span class="badge-unread">Baru</span>
                    @endif
                </h3>
                <p>{{ $notif->message }}</p>
                <small>{{ $notif->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="icon">🔕</div>
            <p>Belum ada notifikasi</p>
        </div>
    @endforelse
</div>

</body>
</html>