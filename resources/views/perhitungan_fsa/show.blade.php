@extends('layouts.app')

@section('title', 'Hasil Perhitungan FSA')

@section('page-title', 'Hasil Perhitungan Farming System Analysis')

@section('content')

<div class="card">

    <h2 style="margin-top: 0;">
        Hasil Perhitungan Farming System Analysis
    </h2>

    @if($perhitungan->user)
        <div style="
            margin-bottom: 20px;
            padding: 12px;
            background: #f1f8f4;
            border-left: 4px solid #198754;
            border-radius: 6px;
        ">
            <strong>Petani/User:</strong>
            {{ $perhitungan->user->nama_user }}

            @if($perhitungan->user->email)
                <br>
                <small>
                    {{ $perhitungan->user->email }}
                </small>
            @endif
        </div>
    @endif

    <div style="overflow-x: auto;">

        <table
            width="100%"
            cellpadding="12"
            cellspacing="0"
            border="1"
            style="
                border-collapse: collapse;
                min-width: 700px;
            "
        >

            <tr>
                <th width="35%">
                    Komoditas Unggulan
                </th>

                <td>
                    {{
                        $perhitungan
                            ->komoditasUnggulan
                            ->nama_komoditas ?? '-'
                    }}
                </td>
            </tr>

            <tr>
                <th>
                    Komoditas Pembanding
                </th>

                <td>
                    {{
                        $perhitungan
                            ->komoditasPembanding
                            ->nama_komoditas ?? '-'
                    }}
                </td>
            </tr>

            <tr>
                <th>
                    Jenis Sektor
                </th>

                <td>
                    {{ $perhitungan->jenis_sektor }}
                </td>
            </tr>

            <tr>
                <th>
                    Keuntungan Komoditas Pembanding (ei)
                </th>

                <td>
                    Rp {{
                        number_format(
                            $perhitungan->keuntungan_ei,
                            2,
                            ',',
                            '.'
                        )
                    }} /ha
                </td>
            </tr>

            <tr>
                <th>
                    Biaya Produksi Komoditas Unggulan (d0)
                </th>

                <td>
                    Rp {{
                        number_format(
                            $perhitungan->biaya_produksi_d0,
                            2,
                            ',',
                            '.'
                        )
                    }} /ha
                </td>
            </tr>

            <tr>
                <th>
                    Produksi Komoditas Unggulan (t0)
                </th>

                <td>
                    {{
                        number_format(
                            $perhitungan->produksi_t0,
                            2,
                            ',',
                            '.'
                        )
                    }} Kg/ha
                </td>
            </tr>

            <tr>
                <th>
                    Harga Minimal (hi)
                </th>

                <td>
                    <strong style="
                        font-size: 18px;
                        color: #198754;
                    ">
                        Rp {{
                            number_format(
                                $perhitungan->harga_minimal_hi,
                                2,
                                ',',
                                '.'
                            )
                        }} /Kg
                    </strong>
                </td>
            </tr>

            <tr>
                <th>
                    Periode
                </th>

                <td>
                    {{ $perhitungan->periode ?? '-' }}
                </td>
            </tr>

        </table>

    </div>

</div>


<div
    class="card"
    style="margin-top: 20px;"
>

    <h2 style="margin-top: 0;">
        Tindak Lanjut Analisis
    </h2>

    <p>
        Hasil perhitungan FSA menunjukkan harga minimal
        komoditas unggulan berdasarkan data yang dimasukkan.
    </p>

    <p>
        Rumus:
        <strong>
            hi = (ei + d0) / t0
        </strong>
    </p>

    <p>
        Harga Minimal:
        <strong>
            Rp {{
                number_format(
                    $perhitungan->harga_minimal_hi,
                    2,
                    ',',
                    '.'
                )
            }} /Kg
        </strong>
    </p>

</div>


<div
    class="card"
    style="margin-top: 20px;"
>

    <h3 style="margin-top: 0;">
        Lanjutkan Analisis E-Farming
    </h3>

    <div style="
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    ">

        <a
            href="{{ route('perhitungan-fsa.index') }}"
            style="
                background: #6c757d;
                color: white;
                text-decoration: none;
                padding: 10px 14px;
                border-radius: 6px;
            "
        >
            Riwayat FSA
        </a>

        <a
            href="{{ route('penilaian-lahan.index') }}"
            style="
                background: #198754;
                color: white;
                text-decoration: none;
                padding: 10px 14px;
                border-radius: 6px;
            "
        >
            Penilaian Lahan
        </a>

        <a
            href="{{ route('kelayakan.index') }}"
            style="
                background: #198754;
                color: white;
                text-decoration: none;
                padding: 10px 14px;
                border-radius: 6px;
            "
        >
            Data Kelayakan
        </a>

        <a
            href="{{ route('solusi.index') }}"
            style="
                background: #198754;
                color: white;
                text-decoration: none;
                padding: 10px 14px;
                border-radius: 6px;
            "
        >
            Solusi / Rekomendasi
        </a>

    </div>

</div>

@endsection