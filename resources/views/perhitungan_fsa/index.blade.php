@extends('layouts.app')

@section('title', 'Riwayat FSA')

@section('page-title', 'Riwayat Perhitungan Farming System Analysis')

@section('content')



<div class="card">

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    ">

        <h2 style="margin: 0;">
            Riwayat Perhitungan FSA
        </h2>

        <a
            href="{{ route('perhitungan-fsa.create') }}"
            style="
                background: #198754;
                color: white;
                text-decoration: none;
                padding: 10px 16px;
                border-radius: 6px;
            "
        >
            + Perhitungan Baru
        </a>

    </div>

    <form
        action="{{ route('perhitungan-fsa.index') }}"
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
            placeholder="Cari petani, komoditas, sektor, atau periode..."
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
                href="{{ route('perhitungan-fsa.index') }}"
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
            width="100%"
            cellpadding="10"
            cellspacing="0"
            border="1"
            style="
                border-collapse: collapse;
                min-width: 1100px;
            "
        >

            <thead>
                <tr>
                    <th>No</th>

                    @if(Auth::user()->isSuperAdmin())
                        <th>Petani/User</th>
                    @endif

                    <th>Komoditas Unggulan</th>
                    <th>Komoditas Pembanding</th>
                    <th>Sektor</th>
                    <th>Keuntungan (ei)</th>
                    <th>Biaya Produksi (d0)</th>
                    <th>Produksi (t0)</th>
                    <th>Harga Minimal (hi)</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                </tr>
            </thead>


            <tbody>

                @forelse ($dataPerhitungan as $item)

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
                            {{
                                $item
                                    ->komoditasUnggulan
                                    ->nama_komoditas ?? '-'
                            }}
                        </td>


                        <td>
                            {{
                                $item
                                    ->komoditasPembanding
                                    ->nama_komoditas ?? '-'
                            }}
                        </td>


                        <td>
                            {{ $item->jenis_sektor }}
                        </td>


                        <td>
                            Rp {{
                                number_format(
                                    $item->keuntungan_ei,
                                    2,
                                    ',',
                                    '.'
                                )
                            }} /ha
                        </td>


                        <td>
                            Rp {{
                                number_format(
                                    $item->biaya_produksi_d0,
                                    2,
                                    ',',
                                    '.'
                                )
                            }} /ha
                        </td>


                        <td>
                            {{
                                number_format(
                                    $item->produksi_t0,
                                    2,
                                    ',',
                                    '.'
                                )
                            }} Kg/ha
                        </td>


                        <td>
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
                        </td>


                        <td>
                            {{ $item->periode ?? '-' }}
                        </td>


                        <td>

                            <a
                                href="{{
                                    route(
                                        'perhitungan-fsa.show',
                                        $item->id_perhitungan
                                    )
                                }}"
                                style="
                                    display: inline-block;
                                    background: #0d6efd;
                                    color: white;
                                    text-decoration: none;
                                    padding: 7px 10px;
                                    border-radius: 5px;
                                    margin-bottom: 5px;
                                "
                            >
                                Detail
                            </a>


                            @if(Auth::user()->isSuperAdmin())

                                <form
                                    action="{{
                                        route(
                                            'perhitungan-fsa.destroy',
                                            $item->id_perhitungan
                                        )
                                    }}"
                                    method="POST"
                                    style="display:inline;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="
                                            return confirm(
                                                'Yakin ingin menghapus data ini?'
                                            )
                                        "
                                        style="
                                            background: #dc3545;
                                            color: white;
                                            border: none;
                                            padding: 8px 10px;
                                            border-radius: 5px;
                                            cursor: pointer;
                                        "
                                    >
                                        Hapus
                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>


                @empty

                    <tr>

                      @if(!empty($search))

    Data FSA dengan pencarian
    "<strong>{{ $search }}</strong>"
    tidak ditemukan.

@else

    Belum ada data perhitungan FSA.

@endif

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection