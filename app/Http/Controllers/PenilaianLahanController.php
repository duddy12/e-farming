<?php

namespace App\Http\Controllers;

use App\Models\PenilaianLahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class PenilaianLahanController extends Controller
{
    public function index()
    {
       $query = PenilaianLahan::with('user');

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }
     $dataPenilaian = $query
        ->orderBy(
            'id_penilaian',
            'desc'
        )
        ->get();

    return view(
        'penilaian_lahan.index',
        compact('dataPenilaian')
    );
    }

   public function create()
{
     abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menambah penilaian lahan.'
    );
    $daftarUser = collect();

    if (Auth::user()->isSuperAdmin()) {
        $daftarUser = User::where(
            'role',
            'user'
        )
        ->orderBy(
            'nama_user',
            'asc'
        )
        ->get();
    }

    return view(
        'penilaian_lahan.create',
        compact('daftarUser')
    );
}

    public function store(Request $request)
{
     abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menambah penilaian lahan.'
    );
    $userId = Auth::id();

    if (Auth::user()->isSuperAdmin()) {
        $request->validate([
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
        ]);

        $userId = $request->id_user;
    }

    $validated = $request->validate([
        'Tingkat_Erosi' => [
            'required',
            'string',
            'max:100',
        ],

        'Kondisi_Dreinase' => [
            'required',
            'string',
            'max:100',
        ],

        'Tekstur_Tanah' => [
            'required',
            'string',
            'max:100',
        ],

        'Kondisi_basah' => [
            'required',
            'string',
            'max:100',
        ],

        'Kondisi_kering' => [
            'required',
            'string',
            'max:100',
        ],

        'periode' => [
            'nullable',
            'date',
        ],
    ]);

    $validated['id_user'] = $userId;

    PenilaianLahan::create($validated);

    return redirect()
        ->route('penilaian-lahan.index')
        ->with(
            'success',
            'Data penilaian lahan berhasil ditambahkan.'
        );
}

    public function edit($id)
    {
         abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menambah penilaian lahan.'
    );
        $query = PenilaianLahan::query();

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $penilaian = $query->findOrFail($id);

    return view(
        'penilaian_lahan.edit',
        compact('penilaian')
    );
    }

    public function update(Request $request, $id)
    {
         abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menambah penilaian lahan.'
    );
       $query = PenilaianLahan::query();

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $penilaian = $query->findOrFail($id);

    $validated = $request->validate([
        'Tingkat_Erosi' => [
            'required',
            'string',
            'max:100',
        ],

        'Kondisi_Dreinase' => [
            'required',
            'string',
            'max:100',
        ],

        'Tekstur_Tanah' => [
            'required',
            'string',
            'max:100',
        ],

        'Kondisi_basah' => [
            'required',
            'string',
            'max:100',
        ],

        'Kondisi_kering' => [
            'required',
            'string',
            'max:100',
        ],

        'periode' => [
            'nullable',
            'date',
        ],
    ]);

    $penilaian->update($validated);

    return redirect()
        ->route('penilaian-lahan.index')
        ->with(
            'success',
            'Data penilaian lahan berhasil diperbarui.'
        );
    }

    public function destroy($id)
    {   
         abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menambah penilaian lahan.'
    );
        $query = PenilaianLahan::query();

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $penilaian = $query->findOrFail($id);

    if ($penilaian->kelayakan()->exists()) {
        return redirect()
            ->route('penilaian-lahan.index')
            ->with(
                'error',
                'Penilaian lahan tidak dapat dihapus karena '
                . 'sudah digunakan dalam data kelayakan.'
            );
    }

    $penilaian->delete();

    return redirect()
        ->route('penilaian-lahan.index')
        ->with(
            'success',
            'Data penilaian lahan berhasil dihapus.'
        );
    }
}