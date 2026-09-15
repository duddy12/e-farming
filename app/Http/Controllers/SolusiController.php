<?php

namespace App\Http\Controllers;

use App\Models\Solusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;

class SolusiController extends Controller
{
    public function index(Request $request)
{
    $query = Solusi::with('user');

    // Petani hanya dapat melihat solusi miliknya sendiri
    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $search = trim($request->input('search', ''));

    if ($search !== '') {

        $query->where(function ($q) use ($search) {

            // Cari berdasarkan kategori solusi
            $q->where(
                'kategori_solusi',
                'like',
                '%' . $search . '%'
            );

            // Cari berdasarkan deskripsi
            $q->orWhere(
                'desc',
                'like',
                '%' . $search . '%'
            );

            // Cari berdasarkan tanggal upload
            $q->orWhere(
                'tgl_upload',
                'like',
                '%' . $search . '%'
            );

            // Cari berdasarkan nama / username petani
            $q->orWhereHas(
                'user',
                function ($userQuery) use ($search) {

                    $userQuery->where(
                        'nama_user',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'user_name',
                        'like',
                        '%' . $search . '%'
                    );
                }
            );

        });
    }

    $dataSolusi = $query
        ->orderBy(
            'id_solusi',
            'desc'
        )
        ->get();

    return view(
        'solusi.index',
        compact(
            'dataSolusi',
            'search'
        )
    );
}

    public function create()
{
    abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menambahkan solusi.'
    );

    $daftarUser = User::where(
        'role',
        'user'
    )
    ->orderBy(
        'nama_user',
        'asc'
    )
    ->get();

    return view(
        'solusi.create',
        compact('daftarUser')
    );
}

   public function store(Request $request)
{
    abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menambahkan solusi.'
    );

    $validated = $request->validate([
        'id_user' => [
            'required',
            Rule::exists(
                'tb_user',
                'id_user'
            )->where(
                'role',
                'user'
            ),
        ],

        'kategori_solusi' => [
            'required',
            'string',
            'max:255',
        ],

        'desc' => [
            'nullable',
            'string',
        ],

        'tgl_upload' => [
            'required',
            'date',
        ],
    ]);

    Solusi::create($validated);

    return redirect()
        ->route('solusi.index')
        ->with(
            'success',
            'Data solusi berhasil ditambahkan.'
        );
}

    public function edit($id)
    {
        abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk mengedit solusi.'
    );

    $solusi = Solusi::findOrFail($id);

    $daftarUser = User::where(
        'role',
        'user'
    )
    ->orderBy(
        'nama_user',
        'asc'
    )
    ->get();

    return view(
        'solusi.edit',
        compact(
            'solusi',
            'daftarUser'
        )
    );
    }

    public function update(Request $request, $id)
    {
        abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
    'Anda tidak memiliki akses untuk menambah solusi.'
);
        $solusi = Solusi::findOrFail($id);

        $validated = $request->validate([
            'kategori_solusi' => [
                'required',
                'string',
                'max:255',
            ],

            'desc' => [
                'nullable',
                'string',
            ],

            'tgl_upload' => [
                'required',
                'date',
            ],
        ]);

        $solusi->update($validated);

        return redirect()
            ->route('solusi.index')
            ->with(
                'success',
                'Data solusi berhasil diperbarui.'
            );
    }

    public function destroy($id)
    {
        abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menambah solusi.'
);
        $solusi = Solusi::findOrFail($id);

        $solusi->delete();

        return redirect()
            ->route('solusi.index')
            ->with(
                'success',
                'Data solusi berhasil dihapus.'
            );
    }
}