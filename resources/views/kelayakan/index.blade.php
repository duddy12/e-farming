@extends('layouts.app')

@section('title', 'Data Kelayakan')

@section('page-title', 'Data Kelayakan')

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
                Data Kelayakan
            </h2>

            <p>
                Daftar hasil kelayakan lahan pertanian.
            </p>
        </div>

        <a
            href="{{ route('kelayakan.create') }}"
            class="btn"
        >
            + Tambah Kelayakan
        </a>

    </div>

     <form
        action="{{ route('kelayakan.index') }}"
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
            placeholder="Cari petani, sektor, lahan, bibit, pupuk, atau hasil kelayakan..."
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
                href="{{ route('kelayakan.index') }}"
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
                    <th>Sektor</th>
                    <th>Penilaian Lahan</th>
                    <th>Presentasi Lahan</th>
                    <th>Hasil Kelayakan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($dataKelayakan as $item)

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
                        {{ $item->id_sektor }}
                    </td>

                    <td>
                        @if($item->penilaianLahan)

                            Erosi:
                            {{ $item->penilaianLahan->Tingkat_Erosi }}

                            <br>

                            Drainase:
                            {{ $item->penilaianLahan->Kondisi_Dreinase }}

                            <br>

                            Tekstur:
                            {{ $item->penilaianLahan->Tekstur_Tanah }}

                        @else

                            -

                        @endif
                    </td>

                    <td>
                        @if($item->presentasi)

                            Bibit:
                            {{ $item->presentasi->bibit_tanaman }}

                            <br>

                            Pupuk:
                            {{ $item->presentasi->siklus_pupuk }}

                        @else

                            -

                        @endif
                    </td>

                    <td>
                        {{ $item->hasil_kelayakan }}
                    </td>

                    <td style="white-space: nowrap;">

                        <a
                            href="{{ route('kelayakan.edit', $item->id_kelayakan) }}"
                            class="btn"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('kelayakan.destroy', $item->id_kelayakan) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="
                                return confirm(
                                    'Yakin ingin menghapus data kelayakan ini?'
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
    colspan="{{ Auth::user()->isSuperAdmin() ? 7 : 6 }}"
    style="
        text-align: center;
        padding: 25px;
    "
>
    @if(!empty($search))

        Data kelayakan dengan pencarian
        "<strong>{{ $search }}</strong>"
        tidak ditemukan.

    @else

        Belum ada data kelayakan.

    @endif
</td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection