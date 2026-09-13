@extends('layouts.app')

@section('title', 'Data Penilaian Lahan')

@section('page-title', 'Data Penilaian Lahan')

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
                Data Penilaian Lahan
            </h2>

            <p>
                Daftar hasil penilaian kondisi lahan pertanian.
            </p>
        </div>

        <a
            href="{{ route('penilaian-lahan.create') }}"
            class="btn"
        >
            + Tambah Penilaian
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
                    <th>Tingkat Erosi</th>
                    <th>Kondisi Drainase</th>
                    <th>Tekstur Tanah</th>
                    <th>Kondisi Basah</th>
                    <th>Kondisi Kering</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($dataPenilaian as $item)

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
                        {{ $item->Tingkat_Erosi }}
                    </td>

                    <td>
                        {{ $item->Kondisi_Dreinase }}
                    </td>

                    <td>
                        {{ $item->Tekstur_Tanah }}
                    </td>

                    <td>
                        {{ $item->Kondisi_basah }}
                    </td>

                    <td>
                        {{ $item->Kondisi_kering }}
                    </td>

                    <td>
                        {{ $item->periode ?? '-' }}
                    </td>

                    <td style="white-space: nowrap;">

                        <a
                            href="{{ route(
                                'penilaian-lahan.edit',
                                $item->id_penilaian
                            ) }}"
                            class="btn"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route(
                                'penilaian-lahan.destroy',
                                $item->id_penilaian
                            ) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="
                                return confirm(
                                    'Yakin ingin menghapus data penilaian ini?'
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
                        style="text-align: center;"
                    >
                        Belum ada data penilaian lahan.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection