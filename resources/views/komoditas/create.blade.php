@extends('layouts.app')

@section('title', 'Tambah Komoditas')

@section('page-title', 'Tambah Komoditas')

@section('content')

<div class="card">

    <h2>Tambah Data Komoditas</h2>

    <p>
        Masukkan data komoditas pertanian.
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
        action="{{ route('komoditas.store') }}"
        method="POST"
    >

        @csrf

        <div style="margin-bottom: 15px;">
            <label>
                <strong>Nama Komoditas</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="nama_komoditas"
                value="{{ old('nama_komoditas') }}"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >
        </div>


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Kategori</strong>
            </label>

            <br><br>

            <select
                name="kategori"
                style="
                    width: 100%;
                    padding: 10px;
                "
            >

                <option value="">
                    -- Pilih Kategori --
                </option>

                <option
                    value="Tanaman Pangan"
                    {{ old('kategori') == 'Tanaman Pangan'
                        ? 'selected' : '' }}
                >
                    Tanaman Pangan
                </option>

                <option
                    value="Hortikultura"
                    {{ old('kategori') == 'Hortikultura'
                        ? 'selected' : '' }}
                >
                    Hortikultura
                </option>

                <option
                    value="Perkebunan"
                    {{ old('kategori') == 'Perkebunan'
                        ? 'selected' : '' }}
                >
                    Perkebunan
                </option>

            </select>
        </div>


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Satuan Produksi</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="satuan_produksi"
                value="{{ old(
                    'satuan_produksi',
                    'Kg/ha'
                ) }}"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >
        </div>


        <div style="margin-bottom: 20px;">
            <label>
                <strong>Keterangan</strong>
            </label>

            <br><br>

            <textarea
                name="keterangan"
                rows="4"
                style="
                    width: 100%;
                    padding: 10px;
                "
            >{{ old('keterangan') }}</textarea>
        </div>


        <button
            type="submit"
            class="btn"
            style="border: none; cursor: pointer;"
        >
            Simpan
        </button>

        <a
            href="{{ route('komoditas.index') }}"
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