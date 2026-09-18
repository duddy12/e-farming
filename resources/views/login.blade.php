<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | E-Farming</title>
	 <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background:
                linear-gradient(
                    rgba(18, 90, 55, 0.85),
                    rgba(8, 55, 35, 0.90)
                );
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            padding: 40px;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.25);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;

            margin: 0 auto 15px;

            border-radius: 50%;

            background: #198754;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 35px;
        }

        .logo h1 {
            color: #198754;
            font-size: 28px;
            margin-bottom: 7px;
        }

        .logo p {
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;

            font-size: 14px;
            font-weight: bold;

            color: #333;
        }

        .form-control {
            width: 100%;

            padding: 13px 15px;

            border: 1px solid #ddd;
            border-radius: 8px;

            font-size: 15px;

            outline: none;

            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #198754;

            box-shadow:
                0 0 0 3px rgba(25, 135, 84, 0.12);
        }

		.password-wrapper {
    position: relative;
}

.password-wrapper .form-control {
    padding-right: 50px;
}

.toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);

    background: none;
    border: none;
    padding: 5px;

    font-size: 20px;
    cursor: pointer;
    color: #666;
}

.toggle-password:hover {
    color: #198754;
}

        .btn-login {
            width: 100%;

            padding: 13px;

            border: none;
            border-radius: 8px;

            background: #198754;
            color: white;

            font-size: 16px;
            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;
        }

        .btn-login:hover {
            background: #146c43;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;

            border-radius: 8px;

            padding: 12px;
            margin-bottom: 20px;

            font-size: 14px;
        }

        .footer {
            text-align: center;

            margin-top: 25px;

            font-size: 12px;
            color: #999;
        }

        @media (max-width: 480px) {

            .login-card {
                padding: 30px 25px;
            }

        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-card">

        {{-- LOGO / JUDUL --}}
        <div class="logo">

            <div class="logo-icon">
                🌱
            </div>

            <h1>E-Farming</h1>

            <p>
                Sistem Informasi Pertanian
            </p>

        </div>


        {{-- ERROR LOGIN --}}
        @if ($errors->any())

            <div class="alert-error">

                @foreach ($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        {{-- FORM LOGIN --}}
        <form
            method="POST"
            action="/login"
        >

            @csrf


            {{-- USERNAME --}}
            <div class="form-group">

                <label for="user_name">
                    Username
                </label>

                <input
                    type="text"
                    name="user_name"
                    id="user_name"
                    class="form-control"
                    value="{{ old('user_name') }}"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    required
                    autofocus
                >

            </div>


            {{-- PASSWORD --}}
<div class="form-group">

    <label for="password">
        Password
    </label>

    <div class="password-wrapper">

        <input
            type="password"
            name="password"
            id="password"
            class="form-control"
            placeholder="Masukkan password"
            autocomplete="current-password"
            required
        >

        <button
            type="button"
            class="toggle-password"
            id="togglePassword"
            aria-label="Tampilkan password"
            title="Tampilkan password"
        >
            👁
        </button>

    </div>

</div>

            <div style="text-align: right; margin-top: -8px; margin-bottom: 15px;">
    <a href="{{ route('password.request') }}"
       style="
           color: #198c55;
           text-decoration: none;
           font-size: 14px;
       ">
        Lupa Password?
    </a>
</div>

            {{-- BUTTON --}}
            <button
                type="submit"
                class="btn-login"
            >
                Login
            </button>

        </form>


        <div class="footer">

            E-Farming System

            <br>

            Farming System Analysis
            Copyright by SemetonWeb 

        </div>

    </div>

</div>

                <script>
    const passwordInput =
        document.getElementById('password');

    const togglePassword =
        document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {

        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

            togglePassword.textContent = '🙈';
            togglePassword.setAttribute(
                'aria-label',
                'Sembunyikan password'
            );

            togglePassword.title =
                'Sembunyikan password';

        } else {

            passwordInput.type = 'password';

            togglePassword.textContent = '👁';
            togglePassword.setAttribute(
                'aria-label',
                'Tampilkan password'
            );

            togglePassword.title =
                'Tampilkan password';
        }

    });
</script>
                
</body>
</html>