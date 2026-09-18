@extends('layouts.app')

@section('title', 'Data Komoditas')

@section('page-title', 'Data Komoditas')

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
                Data Komoditas
            </h2>

            <p>
                Daftar komoditas pertanian E-Farming.
            </p>
        </div>

        <a
            href="{{ route('komoditas.create') }}"
            class="btn"
        >
            + Tambah Komoditas
        </a>

    </div>

    <form
        action="{{ route('komoditas.index') }}"
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
            placeholder="Cari nama, kategori, satuan, atau keterangan..."
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
                href="{{ route('komoditas.index') }}"
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
                <th>Nama Komoditas</th>
                <th>Kategori</th>
                <th>Satuan Produksi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($komoditas as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->nama_komoditas }}
                </td>

                <td>
                    {{ $item->kategori ?? '-' }}
                </td>

                <td>
                    {{ $item->satuan_produksi }}
                </td>

                <td>
                    {{ $item->keterangan ?? '-' }}
                </td>

                <td>

                    <a
                        href="{{ route(
                            'komoditas.edit',
                            $item->id_komoditas
                        ) }}"
                        class="btn"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route(
                            'komoditas.destroy',
                            $item->id_komoditas
                        ) }}"
                        method="POST"
                        style="display: inline;"
                        onsubmit="
                            return confirm(
                                'Yakin ingin menghapus komoditas ini?'
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
    colspan="6"
    style="
        text-align: center;
        padding: 25px;
    "
>
    @if(!empty($search))

        Data komoditas dengan pencarian
        "<strong>{{ $search }}</strong>"
        tidak ditemukan.

    @else

        Belum ada data komoditas.

    @endif
</td>
            </tr>

        @endforelse

        </tbody>

    </table>
	 @if($komoditas->hasPages())

    <div style="
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    ">

        {{-- Previous --}}
        @if($komoditas->onFirstPage())

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
                href="{{ $komoditas->previousPageUrl() }}"
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
        @for($page = 1; $page <= $komoditas->lastPage(); $page++)

            @if($page == $komoditas->currentPage())

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
                    href="{{ $komoditas->url($page) }}"
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
        @if($komoditas->hasMorePages())

            <a
                href="{{ $komoditas->nextPageUrl() }}"
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

@endsection