<!DOCTYPE html>
<html>
<head>

    <title>Profile</title>

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

            display:flex;
            justify-content:space-between;
            align-items:center;

            font-size:24px;
            font-weight:bold;
        }

        .back-btn{
            background:white;
            color:#00aa5b;
            padding:8px 16px;
            border-radius:8px;
            text-decoration:none;
            font-size:14px;
            font-weight:bold;
        }

        .container{
            max-width:900px;
            margin:auto;
            padding:30px;
        }

        .card{
            background:white;
            border-radius:18px;
            padding:30px;
            margin-bottom:25px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .title{
            font-size:28px;
            color:#00aa5b;
            margin-bottom:20px;
        }

        .profile-photo{
            text-align:center;
            margin-bottom:25px;
        }

        .profile-photo img{
            width:140px;
            height:140px;
            border-radius:50%;
            object-fit:cover;
            border:5px solid #00aa5b;
        }

        .form-group{
            margin-bottom:20px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            font-weight:bold;
        }

        .form-control{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:10px;
            box-sizing:border-box;
        }

        .role-badge{
            display:inline-block;
            background:#00aa5b;
            color:white;
            padding:8px 16px;
            border-radius:20px;
            font-weight:bold;
        }

        .btn{
            background:#00aa5b;
            color:white;
            border:none;
            padding:12px 20px;
            border-radius:10px;
            cursor:pointer;
            font-weight:bold;
        }

        .btn:hover{
            background:#00884a;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:12px;
            border-radius:10px;
            margin-bottom:20px;
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

    <div>
        👤 Profile
    </div>

    <a href="{{ route('dashboard') }}"
       class="back-btn">

        ← Dashboard

    </a>

</div>

<div class="container">

    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card">

        <div class="title">

            Informasi Profil

        </div>

        <div class="profile-photo">

            @if($user->profile_photo)

                <img
                    src="{{ asset('storage/'.$user->profile_photo) }}"
                    alt="Profile">

            @else

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=00aa5b&color=ffffff&size=200"
                    alt="Profile">

            @endif

        </div>

        <form
            method="POST"
            action="{{ route('profile.update') }}"
            enctype="multipart/form-data">

            @csrf
            @method('PATCH')

            <div class="form-group">

                <label>

                    Foto Profil

                </label>

                <input
                    type="file"
                    name="profile_photo"
                    class="form-control">

                @error('profile_photo')

                    <div class="error">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="form-group">

                <label>

                    Nama

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$user->name) }}"
                    class="form-control">

                @error('name')

                    <div class="error">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="form-group">

                <label>

                    Email

                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email',$user->email) }}"
                    class="form-control">

                @error('email')

                    <div class="error">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <div class="form-group">

                <label>

                    Role

                </label>

                <div class="role-badge">

                    {{ ucfirst($user->role) }}

                </div>

            </div>

            <button
                type="submit"
                class="btn">

                Update Profile

            </button>

        </form>

    </div>
        <div class="card">

        <div class="title">

            Ubah Password

        </div>

        <form
            method="POST"
            action="{{ route('password.update') }}">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label>

                    Password Saat Ini

                </label>

                <input
                    type="password"
                    name="current_password"
                    class="form-control">

                @if($errors->updatePassword->has('current_password'))

                    <div class="error">

                        {{ $errors->updatePassword->first('current_password') }}

                    </div>

                @endif

            </div>

            <div class="form-group">

                <label>

                    Password Baru

                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control">

                @if($errors->updatePassword->has('password'))

                    <div class="error">

                        {{ $errors->updatePassword->first('password') }}

                    </div>

                @endif

            </div>

            <div class="form-group">

                <label>

                    Konfirmasi Password

                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control">

                @if($errors->updatePassword->has('password_confirmation'))

                    <div class="error">

                        {{ $errors->updatePassword->first('password_confirmation') }}

                    </div>

                @endif

            </div>

            <button
                type="submit"
                class="btn">

                Update Password

            </button>

        </form>

    </div>

    <div class="card">

        <div class="title" style="color:red;">

            Hapus Akun

        </div>

        <p style="color:#666;margin-bottom:20px;">

            Setelah akun dihapus, seluruh data akun akan dihapus secara permanen.
            Masukkan password untuk konfirmasi.

        </p>

        <form
            method="POST"
            action="{{ route('profile.destroy') }}">

            @csrf
            @method('DELETE')

            <div class="form-group">

                <label>

                    Password

                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control">

                @if($errors->userDeletion->has('password'))

                    <div class="error">

                        {{ $errors->userDeletion->first('password') }}

                    </div>

                @endif

            </div>

            <button
                type="submit"
                class="btn"
                onclick="return confirm('Yakin ingin menghapus akun?')"
                style="background:#dc3545;">

                Hapus Akun

            </button>

        </form>

    </div>

</div>

</body>
</html>