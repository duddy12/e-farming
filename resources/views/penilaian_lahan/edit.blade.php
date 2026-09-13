@extends('layouts.app')

@section('title', 'Edit Penilaian Lahan')

@section('page-title', 'Edit Penilaian Lahan')

@section('content')

<div class="card">

    <h2>Edit Data Penilaian Lahan</h2>

    <p>
        Ubah data kondisi lahan pertanian.
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
        action="{{ route(
            'penilaian-lahan.update',
            $penilaian->id_penilaian
        ) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div style="margin-bottom: 15px;">
            <label>
                <strong>Tingkat Erosi</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="Tingkat_Erosi"
                value="{{ old(
                    'Tingkat_Erosi',
                    $penilaian->Tingkat_Erosi
                ) }}"
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
                value="{{ old(
                    'Kondisi_Dreinase',
                    $penilaian->Kondisi_Dreinase
                ) }}"
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
                value="{{ old(
                    'Tekstur_Tanah',
                    $penilaian->Tekstur_Tanah
                ) }}"
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
                value="{{ old(
                    'Kondisi_basah',
                    $penilaian->Kondisi_basah
                ) }}"
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
                value="{{ old(
                    'Kondisi_kering',
                    $penilaian->Kondisi_kering
                ) }}"
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
                value="{{ old(
                    'periode',
                    $penilaian->periode
                ) }}"
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
            Update
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