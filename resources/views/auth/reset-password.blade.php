<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password | E-Farming</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(
                135deg,
                #34795d,
                #145238
            );

            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-card {
            width: 380px;
            background: #ffffff;
            padding: 35px 40px;
            border-radius: 16px;
        }

        .title {
            text-align: center;
            color: #159455;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            font-size: 16px;
            margin-bottom: 25px;
        }

        .description {
            text-align: center;
            color: #555;
            line-height: 1.3;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #222;
            border-radius: 9px;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #159455;
        }

        .email-info {
            padding: 10px;
            background: #f2f2f2;
            border-radius: 7px;
            margin-bottom: 20px;
            color: #555;
            word-break: break-word;
        }

        .btn-reset {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #199456;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-reset:hover {
            background: #147a47;
        }

        .back-login {
            text-align: center;
            margin-top: 25px;
        }

        .back-login a {
            color: #159455;
            text-decoration: none;
        }

        .error-box {
            background: #fde8e8;
            color: #b91c1c;
            padding: 10px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="reset-card">

    <div class="title">
        E-Farming
    </div>

    <div class="subtitle">
        Buat Password Baru
    </div>

    <div class="description">
        Silakan masukkan password baru untuk akun
        E-Farming Anda.
    </div>

    @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="email-info">
        <strong>Email:</strong><br>
        {{ $email }}
    </div>

    <form
        method="POST"
        action="{{ route('password.update') }}"
    >

        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ $token }}"
        >

        <input
            type="hidden"
            name="email"
            value="{{ $email }}"
        >

        <div class="form-group">

            <label>
                Password Baru
            </label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan password baru"
                minlength="8"
                required
            >

        </div>

        <div class="form-group">

            <label>
                Konfirmasi Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                placeholder="Ulangi password baru"
                minlength="8"
                required
            >

        </div>

        <button
            type="submit"
            class="btn-reset"
        >
            Simpan Password Baru
        </button>

    </form>

    <div class="back-login">
        <a href="{{ route('login') }}">
            ← Kembali ke Login
        </a>
    </div>

</div>

</body>
</html>