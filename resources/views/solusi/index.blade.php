@extends('layouts.app')

@section('title', 'Data Solusi')
@section('page-title', 'Data Solusi')

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
                Data Solusi
            </h2>

            <p>
                Daftar solusi dan rekomendasi pertanian.
            </p>
        </div>

        <a
            href="{{ route('solusi.create') }}"
            class="btn"
        >
            + Tambah Solusi
        </a>

    </div>


         <form
        action="{{ route('solusi.index') }}"
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
            placeholder="Cari petani, kategori, deskripsi, atau tanggal..."
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
                    @if(Auth::user()->isSuperAdmin())
                    <th>Nama Petani/User</th>
                    @endif
                    <th>Kategori Solusi</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($dataSolusi as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>
                    @if(Auth::user()->isSuperAdmin())
                    <td>
                    {{ $item->user->nama_user ?? '-' }}
                    </td>
                    @endif

                    <td>
                        {{ $item->kategori_solusi }}
                    </td>

                    <td>
                        {{ $item->desc ?? '-' }}
                    </td>

                    <td>
                        {{ $item->tgl_upload ?? '-' }}
                    </td>

                    <td style="white-space: nowrap;">

                        <a
                            href="{{ route(
                                'solusi.edit',
                                $item->id_solusi
                            ) }}"
                            class="btn"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route(
                                'solusi.destroy',
                                $item->id_solusi
                            ) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="
                                return confirm(
                                    'Yakin ingin menghapus data solusi ini?'
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
    colspan="{{ Auth::user()->isSuperAdmin() ? 6 : 5 }}"
    style="
        text-align: center;
        padding: 25px;
    "
>
    @if(!empty($search))

        Data solusi dengan pencarian
        "<strong>{{ $search }}</strong>"
        tidak ditemukan.

    @else

        Belum ada data solusi.

    @endif
</td>
                </tr>

            @endforelse

            </tbody>

        </table>
        @if($dataSolusi->hasPages())

    <div style="
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    ">

        {{-- Previous --}}
        @if($dataSolusi->onFirstPage())

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
                href="{{ $dataSolusi->previousPageUrl() }}"
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
            $page <= $dataSolusi->lastPage();
            $page++
        )

            @if($page == $dataSolusi->currentPage())

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
                    href="{{ $dataSolusi->url($page) }}"
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
        @if($dataSolusi->hasMorePages())

            <a
                href="{{ $dataSolusi->nextPageUrl() }}"
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