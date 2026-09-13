<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'E-Farming')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f5;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #1b5e20;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            margin-top: 0;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar .user-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 11px 12px;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #2e7d32;
        }

        .menu-title {
            font-size: 12px;
            color: #c8e6c9;
            margin-top: 20px;
            margin-bottom: 7px;
            text-transform: uppercase;
        }

        .logout-button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background: #b71c1c;
            color: white;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #d32f2f;
        }

        .main-content {
            flex: 1;
        }

        .navbar {
            height: 65px;
            background: white;
            display: flex;
            align-items: center;
            padding: 0 30px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar h3 {
            margin: 0;
            color: #1b5e20;
        }

        .content {
            padding: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #2e7d32;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #1b5e20;
        }
    </style>
</head>

<body>

<div class="wrapper">

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <h2>E-Farming</h2>

        <div class="user-info">
            <strong>
                {{ Auth::user()->nama_user }}
            </strong>

            <br>

            <small>
                User ID: {{ Auth::id() }}
            </small>
        </div>

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

    @if(Auth::user()->isSuperAdmin())

        <div class="menu-title">
                Manajemen Sistem
        </div>

        <a href="{{ route('users.index') }}">
                Kelola User / Petani
        </a>

    @endif

       <div class="menu-title">
    Farming System Analysis
</div>

@if(Auth::user()->isSuperAdmin())

    <a href="{{ route('perhitungan-fsa.create') }}">
        Hitung FSA
    </a>

@endif

<a href="{{ route('perhitungan-fsa.index') }}">
    Riwayat FSA
</a>

<a href="{{ route('analisis.index') }}">
    Hasil Analisis
</a>


<div class="menu-title">
    Data Pertanian
</div>

@if(Auth::user()->isSuperAdmin())

    <a href="{{ route('komoditas.index') }}">
        Komoditas
    </a>

@endif

<a href="{{ route('penilaian-lahan.index') }}">
    Penilaian Lahan
</a>

<a href="{{ route('kelayakan.index') }}">
    Kelayakan
</a>

<a href="{{ route('siklus.index') }}">
    Siklus
</a>

<a href="{{ route('solusi.index') }}">
    Solusi
</a>
        <form
            action="{{ route('logout') }}"
            method="POST"
        >
            @csrf

            <button
                type="submit"
                class="logout-button"
            >
                Logout
            </button>
        </form>

    </div>


    {{-- MAIN CONTENT --}}
    <div class="main-content">

        <div class="navbar">
            <h3>
                @yield('page-title', 'Dashboard')
            </h3>
        </div>

        <div class="content">

            @if(session('success'))
                <div
                    class="card"
                    style="border-left: 5px solid #2e7d32;"
                >
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div
                class="card"
                style="
                border-left: 5px solid #c62828;
                color: #b71c1c;">
             {{ session('error') }}
            </div>
            @endif

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>