<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomoditasController extends Controller
{

    private function cekSuperAdmin()
    {
    abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk mengelola data komoditas.'
    );
    }

    // Menampilkan daftar komoditas
  public function index(Request $request)
{
    $this->cekSuperAdmin();

    $search = trim($request->input('search', ''));

    $komoditas = Komoditas::when(
        $search !== '',
        function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where(
                    'nama_komoditas',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'kategori',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'satuan_produksi',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'keterangan',
                    'like',
                    '%' . $search . '%'
                );

            });

        }
    )
    ->orderBy('id_komoditas', 'desc')
    ->paginate(5);

    $komoditas->appends(
    $request->only('search')
);

    return view(
        'komoditas.index',
        compact('komoditas', 'search')
    );
}

    // Menampilkan form tambah komoditas
    public function create()
    {
        $this->cekSuperAdmin();
        return view('komoditas.create');
    }

    // Menyimpan komoditas baru
    public function store(Request $request)
    {
        $this->cekSuperAdmin();
        $validated = $request->validate([
            'nama_komoditas' => [
                'required',
                'string',
                'max:100',
            ],

            'kategori' => [
                'nullable',
                'string',
                'max:100',
            ],

            'satuan_produksi' => [
                'required',
                'string',
                'max:20',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        Komoditas::create($validated);

        return redirect()
            ->route('komoditas.index')
            ->with(
                'success',
                'Data komoditas berhasil ditambahkan.'
            );
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $this->cekSuperAdmin();
        $komoditas = Komoditas::findOrFail($id);

        return view(
            'komoditas.edit',
            compact('komoditas')
        );
    }

    // Memperbarui data komoditas
    public function update(Request $request, $id)
    {
        $this->cekSuperAdmin();
        $komoditas = Komoditas::findOrFail($id);

        $validated = $request->validate([
            'nama_komoditas' => [
                'required',
                'string',
                'max:100',
            ],

            'kategori' => [
                'nullable',
                'string',
                'max:100',
            ],

            'satuan_produksi' => [
                'required',
                'string',
                'max:20',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $komoditas->update($validated);

        return redirect()
            ->route('komoditas.index')
            ->with(
                'success',
                'Data komoditas berhasil diperbarui.'
            );
    }

    // Menghapus data komoditas
    public function destroy($id)
{
    $this->cekSuperAdmin();
    $komoditas = Komoditas::findOrFail($id);

    // Cek apakah komoditas sudah digunakan
    // dalam perhitungan FSA
    $digunakanSebagaiUnggulan =
        $komoditas->perhitunganSebagaiUnggulan()
            ->exists();

    $digunakanSebagaiPembanding =
        $komoditas->perhitunganSebagaiPembanding()
            ->exists();

    if (
        $digunakanSebagaiUnggulan ||
        $digunakanSebagaiPembanding
    ) {
        return redirect()
            ->route('komoditas.index')
            ->with(
                'error',
                'Komoditas tidak dapat dihapus karena '
                . 'sudah digunakan dalam perhitungan FSA.'
            );
    }

    $komoditas->delete();

    return redirect()
        ->route('komoditas.index')
        ->with(
            'success',
            'Data komoditas berhasil dihapus.'
        );
}
}