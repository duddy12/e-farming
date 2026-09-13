<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\PerhitunganFsa;
use App\Models\PenilaianLahan;
use App\Models\Kelayakan;
use App\Models\Solusi;

class UserController extends Controller
{
    /**
     * Pastikan hanya Superadmin yang dapat mengakses
     * pengelolaan user/petani.
     */
    private function cekSuperAdmin()
    {
        abort_unless(
            Auth::user()->isSuperAdmin(),
            403,
            'Anda tidak memiliki akses untuk mengelola user.'
        );
    }

    /**
     * Menampilkan daftar petani.
     */
    public function index()
    {
        $this->cekSuperAdmin();

        $users = User::where('role', 'user')
            ->orderBy('id_user', 'desc')
            ->get();

        return view(
            'users.index',
            compact('users')
        );
    }

    /**
     * Form tambah petani.
     */
    public function create()
    {
        $this->cekSuperAdmin();

        return view('users.create');
    }

    /**
     * Menyimpan petani baru.
     */
    public function store(Request $request)
    {
        $this->cekSuperAdmin();

        $validated = $request->validate([
            'nama_user' => [
                'required',
                'string',
                'max:255',
            ],

            'user_name' => [
                'required',
                'string',
                'max:255',
                'unique:tb_user,user_name',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:tb_user,email',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ]);

        User::create([
            'nama_user' => $validated['nama_user'],
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'password' => Hash::make(
                $validated['password']
            ),
            'role' => 'user',
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Petani berhasil ditambahkan.'
            );
    }

    /**
     * Form edit petani.
     */
    public function show($id)
{
    $this->cekSuperAdmin();

    $user = User::where('role', 'user')
        ->findOrFail($id);

    $perhitunganFsa = \App\Models\PerhitunganFsa::with([
        'komoditasUnggulan',
        'komoditasPembanding',
    ])
        ->where('id_user', $user->id_user)
        ->orderBy('id_perhitungan', 'desc')
        ->get();

    $penilaianLahan = \App\Models\PenilaianLahan::where(
        'id_user',
        $user->id_user
    )
        ->orderBy('id_penilaian', 'desc')
        ->get();

    $kelayakan = \App\Models\Kelayakan::where(
        'id_user',
        $user->id_user
    )
        ->orderBy('id_kelayakan', 'desc')
        ->get();

    $solusi = \App\Models\Solusi::where(
        'id_user',
        $user->id_user
    )
        ->orderBy('id_solusi', 'desc')
        ->get();

    return view(
        'users.show',
        compact(
            'user',
            'perhitunganFsa',
            'penilaianLahan',
            'kelayakan',
            'solusi'
        )
    );
}



    public function edit($id)
    {
        $this->cekSuperAdmin();

        $user = User::where('role', 'user')
            ->findOrFail($id);

        return view(
            'users.edit',
            compact('user')
        );
    }

    /**
     * Update data petani.
     */
    public function update(Request $request, $id)
    {
        $this->cekSuperAdmin();

        $user = User::where('role', 'user')
            ->findOrFail($id);

        $validated = $request->validate([
            'nama_user' => [
                'required',
                'string',
                'max:255',
            ],

            'user_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(
                    'tb_user',
                    'user_name'
                )->ignore(
                    $user->id_user,
                    'id_user'
                ),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(
                    'tb_user',
                    'email'
                )->ignore(
                    $user->id_user,
                    'id_user'
                ),
            ],

            'password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed',
            ],
        ]);

        $user->nama_user = $validated['nama_user'];
        $user->user_name = $validated['user_name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make(
                $validated['password']
            );
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Data petani berhasil diperbarui.'
            );
    }

    /**
     * Menghapus petani.
     */
   public function destroy($id)
{
    $this->cekSuperAdmin();

    $user = User::where('role', 'user')
        ->findOrFail($id);

    $namaUser = $user->nama_user;

    $user->delete();

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            "Petani {$namaUser} berhasil dihapus."
        );
}
}