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

    </div>

</div>

@endsection