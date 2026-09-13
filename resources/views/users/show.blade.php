@extends('layouts.app')

@section('title', 'Detail Petani')

@section('page-title', 'Detail User / Petani')

@section('content')

<div class="card">

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    ">

        <div>
            <h2 style="margin-top: 0; margin-bottom: 8px;">
                {{ $user->nama_user }}
            </h2>

            <div>
                <strong>Username:</strong>
                {{ $user->user_name }}
            </div>

            <div>
                <strong>Email:</strong>
                {{ $user->email }}
            </div>

            <div>
                <strong>Role:</strong>
                {{ $user->role }}
            </div>
        </div>

        <div>
            <a
                href="{{ route('users.edit', $user->id_user) }}"
                class="btn"
            >
                Edit Petani
            </a>
        </div>

    </div>

</div>


<div class="card">

    <h2 style="margin-top: 0;">
        Riwayat Perhitungan FSA
    </h2>

    @forelse($perhitunganFsa as $item)

        <div style="
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 12px;
        ">

            <strong>
                {{
                    $item->komoditasUnggulan->nama_komoditas
                    ?? '-'
                }}
            </strong>

            <div>
                Pembanding:
                {{
                    $item->komoditasPembanding->nama_komoditas
                    ?? '-'
                }}
            </div>

            <div>
                Sektor:
                {{ $item->jenis_sektor }}
            </div>

            <div>
                Harga Minimal:
                <strong>
                    Rp {{
                        number_format(
                            $item->harga_minimal_hi,
                            2,
                            ',',
                            '.'
                        )
                    }} /Kg
                </strong>
            </div>

            <div>
                Periode:
                {{ $item->periode ?? '-' }}
            </div>

        </div>

    @empty

        <p>
            Belum ada data perhitungan FSA.
        </p>

    @endforelse

</div>


<div class="card">

    <h2 style="margin-top: 0;">
        Penilaian Lahan
    </h2>

    @forelse($penilaianLahan as $item)

        <div style="
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 12px;
        ">

            <div>
                <strong>ID Penilaian:</strong>
                {{ $item->id_penilaian }}
            </div>

            <div>
                Tingkat Erosi:
                {{ $item->Tingkat_Erosi }}
            </div>

            <div>
                Kondisi Drainase:
                {{ $item->Kondisi_Dreinase }}
            </div>

            <div>
                Tekstur Tanah:
                {{ $item->Tekstur_Tanah }}
            </div>

            <div>
                Kondisi Basah:
                {{ $item->Kondisi_basah }}
            </div>

            <div>
                Kondisi Kering:
                {{ $item->Kondisi_kering }}
            </div>

            <div>
                Periode:
                {{ $item->periode ?? '-' }}
            </div>

        </div>

    @empty

        <p>
            Belum ada data penilaian lahan.
        </p>

    @endforelse

</div>


<div class="card">

    <h2 style="margin-top: 0;">
        Hasil Kelayakan
    </h2>

    @forelse($kelayakan as $item)

        <div style="
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 12px;
        ">

            <div>
                <strong>ID Kelayakan:</strong>
                {{ $item->id_kelayakan }}
            </div>

            <div>
                Sektor:
                {{ $item->id_sektor }}
            </div>

            <div>
                Penilaian Lahan:
                ID {{ $item->id_penilaian_lahan }}
            </div>

            <div>
                Hasil:
                <strong>
                    {{ $item->hasil_kelayakan }}
                </strong>
            </div>

        </div>

    @empty

        <p>
            Belum ada data kelayakan.
        </p>

    @endforelse

</div>


<div class="card">

    <h2 style="margin-top: 0;">
        Solusi / Rekomendasi
    </h2>

    @forelse($solusi as $item)

        <div style="
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 12px;
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
            Belum ada solusi atau rekomendasi.
        </p>

    @endforelse

</div>


<div style="margin-bottom: 20px;">

    <a
        href="{{ route('users.index') }}"
        style="
            display: inline-block;
            padding: 10px 15px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        "
    >
        Kembali ke Daftar Petani
    </a>

</div>

@endsection