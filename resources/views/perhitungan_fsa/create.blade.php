@extends('layouts.app')

@section('title', 'Perhitungan FSA')

@section('page-title', 'Perhitungan Farming System Analysis')

@section('content')

<div class="card">

    <h2>Perhitungan Farming System Analysis</h2>

    @if ($errors->any())
        <div style="
            background: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        ">
            <strong>Terjadi kesalahan:</strong>

            <ul style="margin-top: 10px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form
        action="{{ route('perhitungan-fsa.store') }}"
        method="POST"
    >
        @csrf


        @if(Auth::user()->isSuperAdmin())
            <div style="margin-bottom: 15px;">

                <label>
                    <strong>Petani/User</strong>
                </label>

                <br><br>

                <select
                    name="id_user"
                    required
                    style="
                        width: 100%;
                        padding: 10px;
                    "
                >
                    <option value="">
                        -- Pilih Petani/User --
                    </option>

                    @foreach($daftarUser as $user)
                        <option
                            value="{{ $user->id_user }}"
                            {{ old('id_user') == $user->id_user ? 'selected' : '' }}
                        >
                            {{ $user->nama_user }}
                        </option>
                    @endforeach

                </select>

            </div>
        @endif


        <div style="margin-bottom: 15px;">

            <label>
                <strong>Komoditas Unggulan</strong>
            </label>

            <br><br>

            <select
                name="id_komoditas_unggulan"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >
                <option value="">
                    -- Pilih Komoditas --
                </option>

                @foreach ($komoditas as $item)

                    <option
                        value="{{ $item->id_komoditas }}"
                        {{ old('id_komoditas_unggulan') == $item->id_komoditas ? 'selected' : '' }}
                    >
                        {{ $item->nama_komoditas }}
                    </option>

                @endforeach

            </select>

        </div>


        <div style="margin-bottom: 15px;">

            <label>
                <strong>Komoditas Pembanding</strong>
            </label>

            <br><br>

            <select
                name="id_komoditas_pembanding"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >
                <option value="">
                    -- Pilih Komoditas --
                </option>

                @foreach ($komoditas as $item)

                    <option
                        value="{{ $item->id_komoditas }}"
                        {{ old('id_komoditas_pembanding') == $item->id_komoditas ? 'selected' : '' }}
                    >
                        {{ $item->nama_komoditas }}
                    </option>

                @endforeach

            </select>

        </div>


        <div style="margin-bottom: 15px;">

            <label>
                <strong>Jenis Sektor</strong>
            </label>

            <br><br>

            <select
                name="jenis_sektor"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >
                <option value="">
                    -- Pilih Sektor --
                </option>

                <option
                    value="DT1"
                    {{ old('jenis_sektor') == 'DT1' ? 'selected' : '' }}
                >
                    DT1 - Daerah Pesisir
                </option>

                <option
                    value="DT2"
                    {{ old('jenis_sektor') == 'DT2' ? 'selected' : '' }}
                >
                    DT2 - Daerah Perbukitan
                </option>

                <option
                    value="DT3"
                    {{ old('jenis_sektor') == 'DT3' ? 'selected' : '' }}
                >
                    DT3 - Daerah Dataran Tinggi
                </option>

            </select>

        </div>


        <div style="margin-bottom: 15px;">

            <label>
                <strong>
                    Keuntungan Komoditas Pembanding (ei)
                </strong>
            </label>

            <br><br>

            <input
                type="number"
                name="keuntungan_ei"
                value="{{ old('keuntungan_ei') }}"
                min="0"
                step="0.01"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label>
                <strong>
                    Biaya Produksi Komoditas Unggulan (d0)
                </strong>
            </label>

            <br><br>

            <input
                type="number"
                name="biaya_produksi_d0"
                value="{{ old('biaya_produksi_d0') }}"
                min="0"
                step="0.01"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label>
                <strong>
                    Produksi Komoditas Unggulan (t0)
                </strong>
            </label>

            <br><br>

            <input
                type="number"
                name="produksi_t0"
                value="{{ old('produksi_t0') }}"
                min="0.01"
                step="0.01"
                required
                style="
                    width: 90%;
                    padding: 10px;
                "
            >

            <span>
                Kg/ha
            </span>

        </div>


        <div style="margin-bottom: 20px;">

            <label>
                <strong>Periode</strong>
            </label>

            <br><br>

            <input
                type="date"
                name="periode"
                value="{{ old('periode') }}"
                style="
                    padding: 10px;
                "
            >

        </div>


        <button
            type="submit"
            style="
                background: #198754;
                color: white;
                border: none;
                padding: 12px 25px;
                border-radius: 6px;
                cursor: pointer;
            "
        >
            Hitung FSA
        </button>

    </form>

</div>

@endsection