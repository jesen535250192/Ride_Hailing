<!DOCTYPE html>
<html>
<head>
    <title>Register - Ride Hailing</title>

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
            margin-top:0;
            text-align:center;
            color:#00aa5b;
        }

        label{
            display:block;
            margin-top:18px;
            margin-bottom:8px;
            font-weight:bold;
        }

        input,
        select{
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
            border:none;
            border-radius:10px;
            background:#00aa5b;
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
        }

        button:hover{
            background:#00884a;
        }

        .login-link{
            text-align:center;
            margin-top:20px;
        }

        .login-link a{
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

        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}">

            @csrf

            <label>Nama</label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required>

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror


            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror


            <label>Daftar Sebagai</label>

            <select name="role" required>

                <option value="">-- Pilih Role --</option>

                <option value="customer"
                    {{ old('role')=='customer'?'selected':'' }}>
                    Customer
                </option>

                <option value="driver"
                    {{ old('role')=='driver'?'selected':'' }}>
                    Driver
                </option>

            </select>

            @error('role')
                <div class="error">{{ $message }}</div>
            @enderror


            <label>Password</label>

            <input
                type="password"
                name="password"
                required>

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror


            <label>Konfirmasi Password</label>

            <input
                type="password"
                name="password_confirmation"
                required>

            <button type="submit">

                Register

            </button>

        </form>

        <div class="login-link">

            Sudah punya akun?

            <br><br>

            <a href="{{ route('login') }}">
                Login
            </a>

        </div>

    </div>

</div>

</body>
</html>