@extends('layouts.app')

@section('title', 'Kelola User')

@section('page-title', 'Kelola User / Petani')

@section('content')

<div class="card">

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    ">

        <h2 style="margin: 0;">
            Daftar Petani
        </h2>

        <a
            href="{{ route('users.create') }}"
            class="btn"
        >
            + Tambah Petani
        </a>

    </div>


    <form
    action="{{ route('users.index') }}"
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
        placeholder="Cari nama, username, atau email..."
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
            href="{{ route('users.index') }}"
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
            cellpadding="12"
            cellspacing="0"
            border="1"
            style="
                border-collapse: collapse;
                min-width: 700px;
            "
        >

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Petani</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $user->nama_user }}
                        </td>

                        <td>
                            {{ $user->user_name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ $user->role }}
                        </td>

                      

                        <td style="white-space: nowrap;">


                        <a
                        href="{{ route('users.show', $user->id_user) }}"
                        style="
                        display: inline-block;
                        padding: 7px 11px;
                        background: #1976d2;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;
                        margin-right: 5px;
                        "
                        >
                        Detail
                        </a>



                            <a
                                href="{{ route('users.edit', $user->id_user) }}"
                                style="
                                    display: inline-block;
                                    padding: 7px 11px;
                                    background: #f9a825;
                                    color: white;
                                    text-decoration: none;
                                    border-radius: 5px;
                                    margin-right: 5px;
                                "
                            >
                                Edit
                            </a>


                            <form
                                action="{{ route('users.destroy', $user->id_user) }}"
                                method="POST"
                                style="display: inline-block;"
                                onsubmit="return confirm('Yakin ingin menghapus petani ini?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    style="
                                        padding: 7px 11px;
                                        background: #c62828;
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
                            Belum ada data petani.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>
       @if($users->hasPages())

    <div style="
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    ">

        {{-- Previous --}}
        @if($users->onFirstPage())

            <span style="
                padding: 8px 12px;
                background: #ddd;
                color: #888;
                border-radius: 5px;
            ">
                &laquo; Previous
            </span>

        @else

            <a
                href="{{ $users->previousPageUrl() }}"
                style="
                    padding: 8px 12px;
                    background: #2e7d32;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                "
            >
                &laquo; Previous
            </a>

        @endif


        {{-- Nomor Halaman --}}
        @for($page = 1; $page <= $users->lastPage(); $page++)

            @if($page == $users->currentPage())

                <span style="
                    padding: 8px 12px;
                    background: #1b5e20;
                    color: white;
                    border-radius: 5px;
                    font-weight: bold;
                ">
                    {{ $page }}
                </span>

            @else

                <a
                    href="{{ $users->url($page) }}"
                    style="
                        padding: 8px 12px;
                        background: #eee;
                        color: #333;
                        text-decoration: none;
                        border-radius: 5px;
                    "
                >
                    {{ $page }}
                </a>

            @endif

        @endfor


        {{-- Next --}}
        @if($users->hasMorePages())

            <a
                href="{{ $users->nextPageUrl() }}"
                style="
                    padding: 8px 12px;
                    background: #2e7d32;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                "
            >
                Next &raquo;
            </a>

        @else

            <span style="
                padding: 8px 12px;
                background: #ddd;
                color: #888;
                border-radius: 5px;
            ">
                Next &raquo;
            </span>

        @endif

    </div>

@endif

    </div>

</div>

@endsection