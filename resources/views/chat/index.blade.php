<!DOCTYPE html>
<html>
<head>
    <title>Chat Order</title>
    <style>
        body{
            margin:0;
            font-family:Arial;
            background:#f4f6f8;
        }

        .navbar{
            background:#00aa5b;
            color:white;
            padding:18px 30px;
            font-size:24px;
            font-weight:bold;
        }

        .container{
            width:600px;
            margin:30px auto;
            background:white;
            padding:25px;
            border-radius:18px;
            box-shadow:0 5px 15px rgba(0,0,0,0.08);
        }

        .message{
            padding:10px;
            margin-bottom:10px;
            border-radius:10px;
            background:#f1f1f1;
        }

        .me{
            background:#d1fae5;
        }

        textarea{
            width:100%;
            padding:10px;
            border-radius:10px;
        }

        button{
            background:#00aa5b;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:10px;
            margin-top:10px;
        }
    </style>
</head>
<body>

<div class="navbar">
    Chat Order #{{ $order->id }}
</div>

<div class="container">

    <a href="/dashboard">
        <button>Kembali</button>
    </a>

    <br><br>

    @foreach ($messages as $msg)
        <div class="message {{ $msg->sender_id == auth()->id() ? 'me' : '' }}">
            <b>{{ $msg->sender->name ?? 'User' }}</b>
            <p>{{ $msg->message }}</p>
            <small>{{ $msg->created_at }}</small>
        </div>
    @endforeach

    <form method="POST" action="{{ route('chat.store', $order->id) }}">
        @csrf

        <textarea name="message" rows="3" placeholder="Tulis pesan..." required></textarea>

        <button type="submit">
            Kirim
        </button>
    </form>

</div>

</body>
</html>