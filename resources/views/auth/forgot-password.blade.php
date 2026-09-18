<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | E-Farming</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #347a59, #174d3b);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .forgot-card {
            width: 380px;
            background: #fff;
            border-radius: 16px;
            padding: 35px 40px;
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo h1 {
            color: #168c54;
            margin-bottom: 5px;
        }

        .logo p {
            color: #777;
            margin-top: 0;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="email"] {
            width: 100%;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 15px;
        }

        button {
            width: 100%;
            border: none;
            padding: 13px;
            border-radius: 8px;
            background: #198c55;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #147346;
        }

        .back-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-login a {
            color: #198c55;
            text-decoration: none;
        }

        .message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="forgot-card">

    <div class="logo">
        <h1>E-Farming</h1>
        <p>Reset Password</p>
    </div>

    <p style="text-align:center; color:#666;">
        Masukkan email yang terdaftar pada sistem E-Farming.
        Kami akan mengirimkan link untuk mengatur ulang password Anda.
    </p>

    @if(session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">

        @csrf

        <label for="email">Email</label>

        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Masukkan email Anda"
            required
            autofocus
        >

        <button type="submit">
            Kirim Link Reset Password
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