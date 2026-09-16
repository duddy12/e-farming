@extends('layouts.app')

@section('title', 'Data Siklus')
@section('page-title', 'Data Siklus')

@section('content')

<div class="card">

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    ">

        <div>
            <h2 style="margin: 0;">
                Data Siklus
            </h2>

            <p>
                Daftar siklus kegiatan pertanian.
            </p>
        </div>

        <a
            href="{{ route('siklus.create') }}"
            class="btn"
        >
            + Tambah Siklus
        </a>

    </div>

    <form
        action="{{ route('siklus.index') }}"
        method="GET"
        style="
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        "
    >

        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Cari petani, sektor, periode, atau deskripsi..."
            style="
                flex: 1;
                min-width: 250px;
                padding: 10px 12px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
            "
        >

        <button
            type="submit"
            class="btn"
        >
            Cari
        </button>

        @if(!empty($search))

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
                Reset
            </a>

        @endif

    </form>

    <div style="overflow-x: auto;">

        <table
            border="1"
            width="100%"
            cellpadding="10"
            cellspacing="0"
            style="border-collapse: collapse;"
        >

            <thead>
    <tr>
        <th>No</th>
        <th>Petugas / Petani</th>
        <th>Sektor</th>
        <th>Periode</th>
        <th>Deskripsi</th>
        <th>Evidence Foto</th>
        <th>Tanggal Evidence</th>
        <th>Aksi</th>
    </tr>
</thead>

<tbody>

@forelse($dataSiklus as $item)

    <tr>

        <td>
            {{ $loop->iteration }}
        </td>

        <td>
            {{ $item->user->nama_user ?? '-' }}
        </td>

        <td>
            Sektor {{ $item->id_sektor }}
        </td>

        <td>
            {{ $item->periode }}
        </td>

        <td>
            {{ $item->desc ?? '-' }}
        </td>

        <td style="text-align: center;">

           @if($item->evidences->count())
             {{ \Carbon\Carbon::parse(
            $item->evidences->last()->tanggal_diambil
             )->format('d-m-Y H:i:s') }}

    <div style="
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        max-width: 320px;
    ">

        @foreach($item->evidences as $evidence)

            <a
                href="{{ asset('storage/' . $evidence->foto_evidence) }}"
                target="_blank"
            >
                <img
                    src="{{ asset('storage/' . $evidence->foto_evidence) }}"
                    alt="Evidence Lahan"
                    style="
                        width: 90px;
                        height: 70px;
                        object-fit: cover;
                        border-radius: 5px;
                        border: 1px solid #ddd;
                    "
                >
            </a>

        @endforeach

    </div>

@else

    <span style="color: #777;">
        Belum ada foto
    </span>

@endif

        </td>

        <td>

            @if($item->tanggal_diambil)

                {{ \Carbon\Carbon::parse($item->tanggal_diambil)
                    ->format('d-m-Y H:i:s') }}

            @else

                -

            @endif

        </td>

        <td style="white-space: nowrap;">

            <a
                href="{{ route(
                    'siklus.edit',
                    $item->id_siklus
                ) }}"
                class="btn"
            >
                Edit
            </a>

            <form
                action="{{ route(
                    'siklus.destroy',
                    $item->id_siklus
                ) }}"
                method="POST"
                style="display: inline;"
                onsubmit="
                    return confirm(
                        'Yakin ingin menghapus data siklus ini?'
                    );
                "
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    style="
                        padding: 10px 15px;
                        background: #b71c1c;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                    "
                >
                    Hapus
                </button>

            </form>

        </td>

    </tr>

@empty

    <tr>
       <td
    colspan="8"
    style="
        text-align: center;
        padding: 25px;
    "
>
    @if(!empty($search))

        Data siklus dengan pencarian
        "<strong>{{ $search }}</strong>"
        tidak ditemukan.

    @else

        Belum ada data siklus.

    @endif
</td>
    </tr>

@endforelse

</tbody>

        </table>
        @if($dataSiklus->hasPages())

    <div style="
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    ">

        {{-- Previous --}}
        @if($dataSiklus->onFirstPage())

            <span style="
                padding: 8px 12px;
                background: #ddd;
                color: #888;
                border-radius: 5px;
            ">
                &laquo; Previous
            </span>

        @else

            <a
                href="{{ $dataSiklus->previousPageUrl() }}"
                style="
                    padding: 8px 12px;
                    background: #2e7d32;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                "
            >
                &laquo; Previous
            </a>

        @endif


        {{-- Nomor Halaman --}}
        @for(
            $page = 1;
            $page <= $dataSiklus->lastPage();
            $page++
        )

            @if($page == $dataSiklus->currentPage())

                <span style="
                    padding: 8px 12px;
                    background: #1b5e20;
                    color: white;
                    border-radius: 5px;
                    font-weight: bold;
                ">
                    {{ $page }}
                </span>

            @else

                <a
                    href="{{ $dataSiklus->url($page) }}"
                    style="
                        padding: 8px 12px;
                        background: #eee;
                        color: #333;
                        text-decoration: none;
                        border-radius: 5px;
                    "
                >
                    {{ $page }}
                </a>

            @endif

        @endfor


        {{-- Next --}}
        @if($dataSiklus->hasMorePages())

            <a
                href="{{ $dataSiklus->nextPageUrl() }}"
                style="
                    padding: 8px 12px;
                    background: #2e7d32;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                "
            >
                Next &raquo;
            </a>

        @else

            <span style="
                padding: 8px 12px;
                background: #ddd;
                color: #888;
                border-radius: 5px;
            ">
                Next &raquo;
            </span>

        @endif

    </div>

@endif

    </div>

</div>

@endsection