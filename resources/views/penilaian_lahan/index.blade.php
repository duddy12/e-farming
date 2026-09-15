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

    <form
        action="{{ route('penilaian-lahan.index') }}"
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
            placeholder="Cari petani, erosi, drainase, tekstur, kondisi, atau periode..."
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
                href="{{ route('penilaian-lahan.index') }}"
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
    colspan="{{ Auth::user()->isSuperAdmin() ? 9 : 8 }}"
    style="
        text-align: center;
        padding: 25px;
    "
>
    @if(!empty($search))

        Data penilaian lahan dengan pencarian
        "<strong>{{ $search }}</strong>"
        tidak ditemukan.

    @else

        Belum ada data penilaian lahan.

    @endif
</td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection