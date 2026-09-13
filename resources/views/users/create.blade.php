@extends('layouts.app')

@section('title', 'Tambah Petani')

@section('page-title', 'Tambah User / Petani')

@section('content')

<div class="card">

    <h2 style="margin-top: 0;">
        Tambah Petani Baru
    </h2>

    @if($errors->any())

        <div style="
            background: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        ">

            <ul style="margin: 0; padding-left: 20px;">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('users.store') }}"
        method="POST"
    >

        @csrf


        <div style="margin-bottom: 15px;">

            <label>
                <strong>Nama Petani</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="nama_user"
                value="{{ old('nama_user') }}"
                required
                style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                "
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label>
                <strong>Username</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="user_name"
                value="{{ old('user_name') }}"
                required
                style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                "
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label>
                <strong>Email</strong>
            </label>

            <br><br>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                "
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label>
                <strong>Password</strong>
            </label>

            <br><br>

            <input
                type="password"
                name="password"
                required
                style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                "
            >

        </div>


        <div style="margin-bottom: 20px;">

            <label>
                <strong>Konfirmasi Password</strong>
            </label>

            <br><br>

            <input
                type="password"
                name="password_confirmation"
                required
                style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                "
            >

        </div>


        <button
            type="submit"
            class="btn"
            style="border: none; cursor: pointer;"
        >
            Simpan Petani
        </button>

        <a
            href="{{ route('users.index') }}"
            style="
                display: inline-block;
                margin-left: 10px;
                padding: 10px 15px;
                background: #6c757d;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            "
        >
            Kembali
        </a>

    </form>

</div>

@endsection