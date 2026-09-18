@extends('layouts.app')

@section('title', 'Tambah Siklus')
@section('page-title', 'Tambah Siklus')

@section('content')

<div class="card">

    <h2>Tambah Data Siklus</h2>

    <p>Masukkan data siklus kegiatan pertanian.</p>

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
        action="{{ route('siklus.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- SEKTOR --}}
        <div style="margin-bottom: 15px;">

            <label>
                <strong>Sektor</strong>
            </label>

            <br><br>

            <select
                name="id_sektor"
                required
                style="width: 100%; padding: 10px;"
            >

                <option value="">
                    -- Pilih Sektor --
                </option>

                <option value="1"
                    {{ old('id_sektor') == '1'
                        ? 'selected' : '' }}
                >
                    Sektor 1
                </option>

                <option value="2"
                    {{ old('id_sektor') == '2'
                        ? 'selected' : '' }}
                >
                    Sektor 2
                </option>

                <option value="3"
                    {{ old('id_sektor') == '3'
                        ? 'selected' : '' }}
                >
                    Sektor 3
                </option>

            </select>

        </div>


        {{-- PERIODE --}}
        <div style="margin-bottom: 15px;">

            <label>
                <strong>Periode</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="periode"
                value="{{ old('periode') }}"
                required
                placeholder="Contoh: 30 Hari"
                style="width: 100%; padding: 10px;"
            >

        </div>


        {{-- DESKRIPSI --}}
        <div style="margin-bottom: 20px;">

            <label>
                <strong>Deskripsi</strong>
            </label>

            <br><br>

            <textarea
                name="desc"
                rows="5"
                placeholder="Masukkan keterangan siklus..."
                style="
                    width: 100%;
                    padding: 10px;
                    resize: vertical;
                "
            >{{ old('desc') }}</textarea>

        </div>


            {{-- EVIDENCE FOTO --}}
        <div style="margin-bottom: 20px;">

    <label>
        <strong>Evidence Foto Lahan</strong>
    </label>

    <input
        type="file"
        name="foto_evidence[]"
        id="foto_evidence"
        accept=".jpg,.jpeg,.png"
        multiple
        required
        style="
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        "
    >

    <div
        id="infoFoto"
        style="
            margin-top: 6px;
            font-size: 12px;
            color: #777;
            font-style: italic;
        "
    >
        * Gunakan aplikasi kamera timestamp.
        Pilih maksimal 6 foto.
        Format JPG, JPEG, atau PNG.
        Maksimal 5 MB per foto.
    </div>

</div>


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
            href="{{ route('siklus.index') }}"
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