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
                    style="text-align: center;"
                >
                    Belum ada data komoditas.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection