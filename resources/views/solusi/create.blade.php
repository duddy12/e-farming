@extends('layouts.app')

@section('title', 'Tambah Solusi')
@section('page-title', 'Tambah Solusi')

@section('content')

<div class="card">

    <h2>Tambah Data Solusi</h2>

    <p>
        Masukkan solusi atau rekomendasi pertanian.
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
        action="{{ route('solusi.store') }}"
        method="POST"
    >

        @csrf

        <div class="mb-3">
    <label for="id_user" class="form-label">
        Pilih Petani/User
    </label>

    <select
        name="id_user"
        id="id_user"
        class="form-control"
        required
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
          <div class="text-danger mt-1">
               {{ $message }}
           </div>
           @enderror
</div>

        <div style="margin-bottom: 15px;">
            <label>
                <strong>Kategori Solusi</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="kategori_solusi"
                value="{{ old('kategori_solusi') }}"
                required
                placeholder="Contoh: Pengairan"
                style="
                    width: 100%;
                    padding: 10px;
                "
            >
        </div>


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Deskripsi Solusi</strong>
            </label>

            <br><br>

            <textarea
                name="desc"
                rows="5"
                placeholder="Masukkan deskripsi solusi..."
                style="
                    width: 100%;
                    padding: 10px;
                    resize: vertical;
                "
            >{{ old('desc') }}</textarea>
        </div>


        <div style="margin-bottom: 20px;">
            <label>
                <strong>Tanggal Upload</strong>
            </label>

            <br><br>

            <input
                type="date"
                name="tgl_upload"
                value="{{ old('tgl_upload') }}"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
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
            href="{{ route('solusi.index') }}"
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