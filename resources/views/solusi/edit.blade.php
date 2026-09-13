@extends('layouts.app')

@section('title', 'Edit Solusi')
@section('page-title', 'Edit Solusi')

@section('content')

<div class="card">

    <h2>Edit Data Solusi</h2>

    <p>
        Ubah data solusi atau rekomendasi pertanian.
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
                {{
                    (string) old('id_user', $solusi->id_user)
                    === (string) $user->id_user
                    ? 'selected'
                    : ''
                }}
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


    <form
        action="{{ route(
            'solusi.update',
            $solusi->id_solusi
        ) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Kategori Solusi</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="kategori_solusi"
                value="{{ old(
                    'kategori_solusi',
                    $solusi->kategori_solusi
                ) }}"
                required
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
                style="
                    width: 100%;
                    padding: 10px;
                    resize: vertical;
                "
            >{{ old(
                'desc',
                $solusi->desc
            ) }}</textarea>
        </div>


        <div style="margin-bottom: 20px;">
            <label>
                <strong>Tanggal Upload</strong>
            </label>

            <br><br>

            <input
                type="date"
                name="tgl_upload"
                value="{{ old(
                    'tgl_upload',
                    $solusi->tgl_upload
                ) }}"
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
            Update
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