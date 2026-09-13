@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard E-Farming')

@section('content')

<div class="card" style="margin-bottom: 20px;">

    <h2 style="margin-top: 0;">
        Selamat Datang, {{ Auth::user()->nama_user }}
    </h2>

    <p>
        Sistem Informasi E-Farming
    </p>

</div>


<div style="
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
">

    @if(Auth::user()->isSuperAdmin())

        <div class="card">
            <h3>Total Petani</h3>

            <div style="
                font-size: 32px;
                font-weight: bold;
                color: #198754;
            ">
                {{ $totalPetani }}
            </div>
        </div>

    @endif

       
    <div class="card">
        <h3>Total Perhitungan FSA</h3>

        <div style="
            font-size: 32px;
            font-weight: bold;
            color: #198754;
        ">
            {{ $totalFsa }}
        </div>
    </div>
    

    <div class="card">
        <h3>Total Penilaian Lahan</h3>

        <div style="
            font-size: 32px;
            font-weight: bold;
            color: #198754;
        ">
            {{ $totalPenilaian }}
        </div>
    </div>


    <div class="card">
        <h3>Total Kelayakan</h3>

        <div style="
            font-size: 32px;
            font-weight: bold;
            color: #198754;
        ">
            {{ $totalKelayakan }}
        </div>
    </div>


    <div class="card">
        <h3>Total Solusi</h3>

        <div style="
            font-size: 32px;
            font-weight: bold;
            color: #198754;
        ">
            {{ $totalSolusi }}
        </div>
    </div>

</div>


<div class="card" style="margin-top: 20px;">

    <h2 style="margin-top: 0;">
        Menu Cepat
    </h2>

    <div style="
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    ">
        @if(Auth::user()->isSuperAdmin())
        <a
            href="{{ route('perhitungan-fsa.create') }}"
            style="
                padding: 10px 15px;
                background: #198754;
                color: white;
                text-decoration: none;
                border-radius: 6px;
            "
        >
            Hitung FSA
        </a>
        @endif
        <a
            href="{{ route('perhitungan-fsa.index') }}"
            style="
                padding: 10px 15px;
                background: #198754;
                color: white;
                text-decoration: none;
                border-radius: 6px;
            "
        >
            Riwayat FSA
        </a>

        <a
            href="{{ route('analisis.index') }}"
            style="
                padding: 10px 15px;
                background: #198754;
                color: white;
                text-decoration: none;
                border-radius: 6px;
            "
        >
            Hasil Analisis
        </a>

    </div>

</div>

@endsection