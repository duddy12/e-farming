@extends('layouts.app')

@section('title', 'Tambah Kelayakan')

@section('page-title', 'Tambah Kelayakan')

@section('content')

<div class="card">

    <h2>Tambah Data Kelayakan</h2>

    <p>
        Masukkan data untuk penilaian kelayakan lahan pertanian.
    </p>

    @if ($errors->any())
        <div style="
            background: #ffebee;
            color: #b71c1c;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        ">
            <strong>Terjadi kesalahan:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Auth::user()->isSuperAdmin())

    

   

    <script>
        function pilihPetani(idUser) {
            if (idUser) {
                window.location.href =
                    "{{ route('kelayakan.create') }}"
                    + "?id_user="
                    + idUser;
            } else {
                window.location.href =
                    "{{ route('kelayakan.create') }}";
            }
        }
    </script>

@endif


    <form
        action="{{ route('kelayakan.store') }}"
        method="POST"
    >

        @csrf

       @if(Auth::user()->isSuperAdmin())

    <div style="margin-bottom: 15px;">

        <label for="pilih_user">
            <strong>Petani/User</strong>
        </label>

        <br><br>

        <select
            name="id_user"
            id="pilih_user"
            required
            onchange="pilihPetani(this.value)"
            style="width: 100%; padding: 10px;"
        >
            <option value="">
                -- Pilih Petani/User --
            </option>

            @foreach($daftarUser as $user)
                <option
                    value="{{ $user->id_user }}"
                    {{ (string) $selectedUserId === (string) $user->id_user
                        ? 'selected'
                        : '' }}
                >
                    {{ $user->nama_user }}
                </option>
            @endforeach

        </select>

        @error('id_user')
            <div style="color: red; margin-top: 5px;">
                {{ $message }}
            </div>
        @enderror

    </div>

@endif

        {{-- SEKTOR --}}
        <div style="margin-bottom: 15px;">

            <label>
                <strong>Sektor</strong>
            </label>

            <br><br>

            <select
                name="id_sektor"
                required
                style="width: 100%; padding: 10px;"
            >

                <option value="">
                    -- Pilih Sektor --
                </option>

                <option
                    value="1"
                    {{ old('id_sektor') == '1'
                        ? 'selected' : '' }}
                >
                    Sektor 1
                </option>

                <option
                    value="2"
                    {{ old('id_sektor') == '2'
                        ? 'selected' : '' }}
                >
                    Sektor 2
                </option>

                <option
                    value="3"
                    {{ old('id_sektor') == '3'
                        ? 'selected' : '' }}
                >
                    Sektor 3
                </option>

            </select>

        </div>


        {{-- PENILAIAN LAHAN --}}
        <div style="margin-bottom: 15px;">

            <label>
                <strong>Penilaian Lahan</strong>
            </label>

            <br><br>

            <select
                name="id_penilaian_lahan"
                required
                style="width: 100%; padding: 10px;"
            >

                <option value="">
                    -- Pilih Penilaian Lahan --
                </option>

                @foreach($penilaianLahan as $item)

                    <option
                        value="{{ $item->id_penilaian }}"
                        {{ old('id_penilaian_lahan')
                            == $item->id_penilaian
                            ? 'selected'
                            : '' }}
                    >
                        ID {{ $item->id_penilaian }}
                        -
                        Erosi: {{ $item->Tingkat_Erosi }}
                        -
                        Drainase: {{ $item->Kondisi_Dreinase }}
                        -
                        Tekstur: {{ $item->Tekstur_Tanah }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- PRESENTASI LAHAN --}}
        <div style="margin-bottom: 15px;">

            <label>
                <strong>Presentasi Lahan</strong>
            </label>

            <br><br>

            <select
                name="id_presentasi_lahan"
                required
                style="width: 100%; padding: 10px;"
            >

                <option value="">
                    -- Pilih Presentasi Lahan --
                </option>

                @foreach($presentasi as $item)

                    <option
                        value="{{ $item->id_presentasi }}"
                        {{ old('id_presentasi_lahan')
                            == $item->id_presentasi
                            ? 'selected'
                            : '' }}
                    >
                        ID {{ $item->id_presentasi }}
                        -
                        Bibit: {{ $item->bibit_tanaman }}
                        -
                        Pupuk: {{ $item->siklus_pupuk }}
                        -
                        Cahaya: {{ $item->presnet_cahaya }}
                        -
                        Pengairan: {{ $item->siklus_pengairan }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- HASIL KELAYAKAN --}}
        <div style="margin-bottom: 20px;">

            <label>
                <strong>Hasil Kelayakan</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="hasil_kelayakan"
                value="{{ old('hasil_kelayakan') }}"
                required
                placeholder="Contoh: Layak"
                style="width: 100%; padding: 10px;"
            >

        </div>


        <button
            type="submit"
            class="btn"
            style="
                border: none;
                cursor: pointer;
            "
        >
            Simpan
        </button>

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
            Kembali
        </a>

    </form>

</div>

@if(Auth::user()->isSuperAdmin())
<script>
    function pilihPetani(idUser) {
        if (idUser) {
            window.location.href =
                "{{ route('kelayakan.create') }}"
                + "?id_user="
                + idUser;
        } else {
            window.location.href =
                "{{ route('kelayakan.create') }}";
        }
    }
</script>
@endif
@endsection