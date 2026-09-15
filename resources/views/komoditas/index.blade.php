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

</div>

@endsection