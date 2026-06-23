<!DOCTYPE html>
<html>
<head>
    <title>Rating Saya</title>

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
            padding:30px;
            max-width:1000px;
            margin:auto;
        }

        .top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .back-btn{
            background:white;
            border:2px solid #00aa5b;
            color:#00aa5b;
            text-decoration:none;
            padding:10px 18px;
            border-radius:10px;
            font-weight:bold;
        }

        .back-btn:hover{
            background:#00aa5b;
            color:white;
        }

        .summary{
            background:white;
            border-radius:15px;
            padding:25px;
            margin-bottom:25px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .summary h2{
            margin:0;
            color:#00aa5b;
        }

        .summary p{
            font-size:20px;
            margin-top:10px;
        }

        .card{
            background:white;
            border-radius:15px;
            padding:20px;
            margin-bottom:20px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .star{
            color:#ffc107;
            font-size:24px;
            margin-bottom:10px;
        }

        .comment{
            margin:15px 0;
            font-size:16px;
        }

        .info{
            color:#666;
            font-size:14px;
        }

        .empty{
            background:white;
            padding:60px;
            text-align:center;
            border-radius:15px;
            color:gray;
        }

    </style>

</head>

<body>

<div class="navbar">
    Rating Saya
</div>

<div class="container">

    <div class="top">

        <h2>Rating Driver</h2>

        <a href="/dashboard" class="back-btn">
            ← Dashboard
        </a>

    </div>

    <div class="summary">

        <h2>⭐ Rata-rata Rating</h2>

        <p>

            {{ $averageRating ?? 0 }}/5

            <br><br>

            Total Rating :

            {{ $ratings->count() }}

        </p>

    </div>

    @forelse($ratings as $rating)

        <div class="card">

            <div class="star">

                @for($i=1;$i<=$rating->rating;$i++)
                    ⭐
                @endfor

            </div>

            <div class="comment">

                {{ $rating->suggestion ?: 'Tidak ada komentar.' }}

            </div>

            <div class="info">

                <strong>Customer :</strong>

                {{ $rating->customer->name }}

            </div>

            <div class="info">

                <strong>Order :</strong>

                #{{ $rating->order->id }}

            </div>

            <div class="info">

                {{ $rating->created_at->format('d M Y H:i') }}

            </div>

        </div>

    @empty

        <div class="empty">

            Belum ada rating yang diterima.

        </div>

    @endforelse

</div>

</body>
</html>