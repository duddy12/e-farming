@extends('layouts.app')

@section('title', 'Hasil Analisis E-Farming')

@section('page-title', 'Hasil Analisis E-Farming')

@section('content')

{{-- =========================
     PILIH PETANI - SUPERADMIN
========================= --}}
@if(Auth::user()->isSuperAdmin())

    <div class="card" style="margin-bottom: 20px;">

        <form
            method="GET"
            action="{{ route('analisis.index') }}"
        >
            <label>
                <strong>Pilih Petani/User</strong>
            </label>

            <br><br>

            <select
                name="id_user"
                onchange="this.form.submit()"
                style="
                    width: 100%;
                    padding: 10px;
                "
            >
                <option value="">
                    -- Pilih Petani/User --
                </option>

                @foreach($daftarUser as $user)

                    <option
                        value="{{ $user->id_user }}"
                        {{ (string) $userId === (string) $user->id_user ? 'selected' : '' }}
                    >
                        {{ $user->nama_user }}
                    </option>

                @endforeach

            </select>

        </form>

    </div>

@endif


{{-- =========================
     BELUM PILIH PETANI
========================= --}}
@if(Auth::user()->isSuperAdmin() && !$petani)

    <div class="card">

        <p style="margin: 0;">
            Silakan pilih Petani/User terlebih dahulu
            untuk melihat hasil analisis.
        </p>

    </div>

@endif


@if($petani)

    {{-- =========================
         IDENTITAS PETANI
    ========================= --}}
    <div class="card" style="margin-bottom: 20px;">

        <h2 style="margin-top: 0;">
            Hasil Analisis Petani
        </h2>

        <p>
            <strong>Nama:</strong>
            {{ $petani->nama_user }}
        </p>

        @if($petani->email)

            <p>
                <strong>Email:</strong>
                {{ $petani->email }}
            </p>

        @endif

    </div>


    {{-- =========================
         HASIL FSA
    ========================= --}}
    <div class="card" style="margin-bottom: 20px;">

        <h2 style="margin-top: 0;">
            Hasil Farming System Analysis
        </h2>

        @if($perhitunganFsa)

            <div style="overflow-x: auto;">

                <table
                    border="1"
                    width="100%"
                    cellpadding="12"
                    cellspacing="0"
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
                                $perhitunganFsa
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
                                $perhitunganFsa
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
                            {{ $perhitunganFsa->jenis_sektor }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Keuntungan Komoditas Pembanding (ei)
                        </th>

                        <td>
                            Rp {{
                                number_format(
                                    $perhitunganFsa->keuntungan_ei,
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
                                    $perhitunganFsa->biaya_produksi_d0,
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
                                    $perhitunganFsa->produksi_t0,
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
                                color: #198754;
                                font-size: 18px;
                            ">
                                Rp {{
                                    number_format(
                                        $perhitunganFsa->harga_minimal_hi,
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
                            {{ $perhitunganFsa->periode ?? '-' }}
                        </td>
                    </tr>

                </table>

            </div>

        @else

            <p>
                Belum ada data perhitungan FSA
                untuk petani ini.
            </p>

        @endif

    </div>


    {{-- =========================
         PENILAIAN LAHAN
    ========================= --}}
    <div class="card" style="margin-bottom: 20px;">

        <h2 style="margin-top: 0;">
            Penilaian Lahan
        </h2>

        @if($penilaianLahan)

            <div style="overflow-x: auto;">

                <table
                    border="1"
                    width="100%"
                    cellpadding="12"
                    cellspacing="0"
                    style="border-collapse: collapse;"
                >

                    <tr>
                        <th width="35%">
                            Tingkat Erosi
                        </th>

                        <td>
                            {{ $penilaianLahan->Tingkat_Erosi }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Kondisi Drainase
                        </th>

                        <td>
                            {{ $penilaianLahan->Kondisi_Dreinase }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Tekstur Tanah
                        </th>

                        <td>
                            {{ $penilaianLahan->Tekstur_Tanah }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Kondisi Basah
                        </th>

                        <td>
                            {{ $penilaianLahan->Kondisi_basah }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Kondisi Kering
                        </th>

                        <td>
                            {{ $penilaianLahan->Kondisi_kering }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Periode
                        </th>

                        <td>
                            {{ $penilaianLahan->periode ?? '-' }}
                        </td>
                    </tr>

                </table>

            </div>

        @else

            <p>
                Belum ada data penilaian lahan
                untuk petani ini.
            </p>

        @endif

    </div>


    {{-- =========================
         KELAYAKAN
    ========================= --}}
    <div class="card" style="margin-bottom: 20px;">

        <h2 style="margin-top: 0;">
            Hasil Kelayakan
        </h2>

        @if($kelayakan)

            <div style="overflow-x: auto;">

                <table
                    border="1"
                    width="100%"
                    cellpadding="12"
                    cellspacing="0"
                    style="border-collapse: collapse;"
                >

                    <tr>
                        <th width="35%">
                            Sektor
                        </th>

                        <td>
                            Sektor {{ $kelayakan->id_sektor }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Penilaian Lahan
                        </th>

                        <td>
                            ID {{ $kelayakan->id_penilaian_lahan }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Hasil Kelayakan
                        </th>

                        <td>
                            <strong style="
                                color: #198754;
                                font-size: 18px;
                            ">
                                {{ $kelayakan->hasil_kelayakan }}
                            </strong>
                        </td>
                    </tr>

                </table>

            </div>

        @else

            <p>
                Belum ada data kelayakan
                untuk petani ini.
            </p>

        @endif

    </div>


    {{-- =========================
         SOLUSI
    ========================= --}}
    <div class="card">

        <h2 style="margin-top: 0;">
            Solusi / Rekomendasi
        </h2>

        @forelse($solusi as $item)

            <div style="
                padding: 15px;
                margin-bottom: 12px;
                border: 1px solid #ddd;
                border-radius: 6px;
                background: #fafafa;
            ">

                <strong>
                    {{ $item->kategori_solusi }}
                </strong>

                <p>
                    {{ $item->desc }}
                </p>

                <small>
                    Tanggal:
                    {{ $item->tgl_upload }}
                </small>

            </div>

        @empty

            <p>
                Belum ada solusi atau rekomendasi
                untuk petani ini.
            </p>

        @endforelse

    </div>

@endif

@endsection