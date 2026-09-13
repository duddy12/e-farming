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
                        colspan="5"
                        style="text-align: center;"
                    >
                        Belum ada data solusi.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection