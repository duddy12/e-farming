@extends('layouts.app')

@section('title', 'Edit Siklus')
@section('page-title', 'Edit Siklus')

@section('content')

<div class="card">

    <h2>Edit Data Siklus</h2>

    <p>
        Ubah data siklus kegiatan pertanian.
    </p>


    {{-- VALIDASI ERROR --}}
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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach
            </ul>

        </div>

    @endif



    {{-- EVIDENCE FOTO LAMA --}}
    <div style="margin-bottom: 30px;">

        <label>
            <strong>Evidence Foto Saat Ini</strong>
        </label>

        <br><br>

        @if($siklus->evidences->count())

            <div style="
                display: flex;
                gap: 15px;
                flex-wrap: wrap;
            ">

                @foreach($siklus->evidences as $evidence)

                    <div style="
                        text-align: center;
                        padding: 10px;
                        border: 1px solid #ddd;
                        border-radius: 6px;
                    ">

                        <a
    					href="{{ asset($evidence->foto_evidence) }}"
   						 target="_blank"
							>
    					<img
        				src="{{ asset($evidence->foto_evidence) }}"
        				alt="Evidence Lahan"
        				style="
            			width: 120px;
            			height: 90px;
            			object-fit: cover;
            			border-radius: 5px;
            			border: 1px solid #ddd;
        				"
    					>
						</a>


                        <div style="
                            font-size: 12px;
                            color: #666;
                            margin-top: 5px;
                        ">

                            {{ \Carbon\Carbon::parse(
                                $evidence->tanggal_diambil
                            )->format('d-m-Y H:i:s') }}

                        </div>


                        {{-- FORM HAPUS EVIDENCE --}}
                        <form
                            action="{{ route(
                                'siklus.evidence.destroy',
                                $evidence->id_evidence
                            ) }}"
                            method="POST"
                            style="margin-top: 8px;"
                            onsubmit="
                                return confirm(
                                    'Yakin ingin menghapus foto evidence ini?'
                                );
                            "
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                style="
                                    padding: 6px 12px;
                                    background: #c62828;
                                    color: white;
                                    border: none;
                                    border-radius: 4px;
                                    cursor: pointer;
                                "
                            >
                                Hapus
                            </button>

                        </form>

                    </div>

                @endforeach

            </div>

        @else

            <span style="color: #777;">
                Belum ada evidence foto.
            </span>

        @endif

    </div>



    {{-- FORM UPDATE SIKLUS --}}
    <form
        action="{{ route(
            'siklus.update',
            $siklus->id_siklus
        ) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- SEKTOR --}}
        <div style="margin-bottom: 15px;">

            <label>
                <strong>Sektor</strong>
            </label>

            <br><br>

            <select
                name="id_sektor"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >

                <option
                    value="1"
                    {{
                        old(
                            'id_sektor',
                            $siklus->id_sektor
                        ) == 1
                        ? 'selected'
                        : ''
                    }}
                >
                    Sektor 1
                </option>


                <option
                    value="2"
                    {{
                        old(
                            'id_sektor',
                            $siklus->id_sektor
                        ) == 2
                        ? 'selected'
                        : ''
                    }}
                >
                    Sektor 2
                </option>


                <option
                    value="3"
                    {{
                        old(
                            'id_sektor',
                            $siklus->id_sektor
                        ) == 3
                        ? 'selected'
                        : ''
                    }}
                >
                    Sektor 3
                </option>

            </select>

        </div>



        {{-- PERIODE --}}
        <div style="margin-bottom: 15px;">

            <label>
                <strong>Periode</strong>
            </label>

            <br><br>

            <input
                type="text"
                name="periode"
                value="{{ old(
                    'periode',
                    $siklus->periode
                ) }}"
                required
                style="
                    width: 100%;
                    padding: 10px;
                "
            >

        </div>



        {{-- DESKRIPSI --}}
        <div style="margin-bottom: 20px;">

            <label>
                <strong>Deskripsi</strong>
            </label>

            <br><br>

            <textarea
                name="desc"
                rows="5"
                required
                style="
                    width: 100%;
                    padding: 10px;
                    resize: vertical;
                "
            >{{ old(
                'desc',
                $siklus->desc
            ) }}</textarea>

        </div>



        {{-- TAMBAH EVIDENCE BARU --}}
        <div style="margin-bottom: 20px;">

            <label>
                <strong>Tambah Evidence Foto Baru</strong>
            </label>

            <br><br>

            <input
                type="file"
                name="foto_evidence[]"
                accept=".jpg,.jpeg,.png"
                multiple
                style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                "
            >

            <br><br>

            <small style="color: #666;">
                Opsional. Maksimal total 6 foto evidence.
                Maksimal 5 MB per foto.
            </small>

        </div>



        {{-- TOMBOL --}}
        <div style="margin-top: 20px;">

            <button
                type="submit"
                class="btn"
                style="
                    border: none;
                    cursor: pointer;
                "
            >
                Update
            </button>


            <a
                href="{{ route('siklus.index') }}"
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

        </div>

    </form>

</div>

@endsection