<!DOCTYPE html>
<html>
<head>
    <title>Login - Ride Hailing</title>

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
            text-align:center;
        }

        .container{
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:90vh;
        }

        .card{
            width:420px;
            background:white;
            padding:35px;
            border-radius:18px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        h2{
            text-align:center;
            color:#00aa5b;
            margin-top:0;
        }

        label{
            display:block;
            margin-top:18px;
            margin-bottom:8px;
            font-weight:bold;
        }

        input{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:10px;
            box-sizing:border-box;
            font-size:15px;
        }

        button{
            width:100%;
            margin-top:25px;
            padding:13px;
            background:#00aa5b;
            color:white;
            border:none;
            border-radius:10px;
            font-size:16px;
            cursor:pointer;
            font-weight:bold;
        }

        button:hover{
            background:#00884a;
        }

        .bottom{
            margin-top:20px;
            text-align:center;
        }

        .bottom a{
            color:#00aa5b;
            text-decoration:none;
            font-weight:bold;
        }

        .error{
            color:red;
            font-size:14px;
            margin-top:5px;
        }

    </style>

</head>

<body>

<div class="navbar">

    🚖 Ride Hailing

</div>

<div class="container">

    <div class="card">

        <h2>Login</h2>

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus>

            @error('email')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

            <label>Password</label>

            <input
                type="password"
                name="password"
                required>

            @error('password')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

            <button type="submit">

                Login

            </button>

        </form>

        <div class="bottom">

            Belum punya akun?

            <br><br>

            <a href="{{ route('register') }}">

                Register

            </a>

        </div>

    </div>

</div>

</body>
</html>