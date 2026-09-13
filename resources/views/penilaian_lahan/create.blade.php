@extends('layouts.app')

@section('title', 'Tambah Penilaian Lahan')

@section('page-title', 'Tambah Penilaian Lahan')

@section('content')

<div class="card">

    <h2>Tambah Data Penilaian Lahan</h2>

    <p>
        Masukkan kondisi lahan pertanian yang akan dinilai.
    </p>

    @if ($errors->any())
        <div style="
            background: #ffebee;
            color: #b71c1c;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        ">
            <strong>Terjadi kesalahan:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form
        action="{{ route('penilaian-lahan.store') }}"
        method="POST"
    >

        @csrf
@if(Auth::user()->isSuperAdmin())

    <div style="margin-bottom: 15px;">

        <label for="id_user">
            <strong>Petani/User</strong>
        </label>

        <br><br>

        <select
            name="id_user"
            id="id_user"
            required
            style="width: 100%; padding: 10px;"
        >
            <option value="">
                -- Pilih Petani/User --
            </option>

            @foreach($daftarUser as $user)
                <option
                    value="{{ $user->id_user }}"
                    {{ old('id_user') == $user->id_user ? 'selected' : '' }}
                >
                    {{ $user->nama_user }}
                </option>
            @endforeach

        </select>

        @error('id_user')
            <div style="color:red; margin-top:5px;">
                {{ $message }}
            </div>
        @enderror

    </div>

@endif

        <div style="margin-bottom: 15px;">
            <label>
                <strong>Tingkat Erosi</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="Tingkat_Erosi"
                value="{{ old('Tingkat_Erosi') }}"
                required
                style="width: 100%; padding: 10px;"
            >
        </div>


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Kondisi Drainase</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="Kondisi_Dreinase"
                value="{{ old('Kondisi_Dreinase') }}"
                required
                style="width: 100%; padding: 10px;"
            >
        </div>


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Tekstur Tanah</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="Tekstur_Tanah"
                value="{{ old('Tekstur_Tanah') }}"
                required
                style="width: 100%; padding: 10px;"
            >
        </div>


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Kondisi Basah</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="Kondisi_basah"
                value="{{ old('Kondisi_basah') }}"
                required
                style="width: 100%; padding: 10px;"
            >
        </div>


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Kondisi Kering</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="Kondisi_kering"
                value="{{ old('Kondisi_kering') }}"
                required
                style="width: 100%; padding: 10px;"
            >
        </div>


        <div style="margin-bottom: 20px;">
            <label>
                <strong>Periode</strong>
            </label>

            <br><br>

            <input
                type="date"
                name="periode"
                value="{{ old('periode') }}"
                style="width: 100%; padding: 10px;"
            >
        </div>


        <button
            type="submit"
            class="btn"
            style="
                border: none;
                cursor: pointer;
            "
        >
            Simpan
        </button>

        <a
            href="{{ route('penilaian-lahan.index') }}"
            style="
                display: inline-block;
                padding: 10px 15px;
                background: #757575;
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