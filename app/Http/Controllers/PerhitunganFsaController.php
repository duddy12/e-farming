<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use App\Models\PerhitunganFsa;
use App\Models\User;
use App\Services\FarmingSystemAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PerhitunganFsaController extends Controller
{
    protected FarmingSystemAnalysis $fsaService;

    public function __construct(FarmingSystemAnalysis $fsaService)
    {
        $this->fsaService = $fsaService;
    }

   public function index()
{
    $query = PerhitunganFsa::with([
        'user',
        'komoditasUnggulan',
        'komoditasPembanding',
    ]);

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $dataPerhitungan = $query
        ->orderBy(
            'id_perhitungan',
            'desc'
        )
        ->get();

    return view(
        'perhitungan_fsa.index',
        compact('dataPerhitungan')
    );
}

   public function create()
{
    abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menghitung FSA.'
    );

    $komoditas = Komoditas::orderBy('nama_komoditas')->get();

    $daftarUser = User::where('role', 'user')
        ->orderBy('nama_user', 'asc')
        ->get();

    return view(
        'perhitungan_fsa.create',
        compact('komoditas', 'daftarUser')
    );
}

    public function store(Request $request)
{
     abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menghitung FSA.'
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

        'id_komoditas_unggulan' => [
            'required',
            'integer',
            'exists:tb_komoditas,id_komoditas',
        ],

        'id_komoditas_pembanding' => [
            'required',
            'integer',
            'exists:tb_komoditas,id_komoditas',
            'different:id_komoditas_unggulan',
        ],

        'jenis_sektor' => [
            'required',
            'in:DT1,DT2,DT3',
        ],

        'keuntungan_ei' => [
            'required',
            'numeric',
            'min:0',
        ],

        'biaya_produksi_d0' => [
            'required',
            'numeric',
            'min:0',
        ],

        'produksi_t0' => [
            'required',
            'numeric',
            'gt:0',
        ],

        'periode' => [
            'nullable',
            'date',
        ],
    ]);

    $hargaMinimalHi = $this->fsaService
        ->hitungHargaMinimal(
            (float) $validated['keuntungan_ei'],
            (float) $validated['biaya_produksi_d0'],
            (float) $validated['produksi_t0']
        );

    $perhitungan = PerhitunganFsa::create([

        'id_user' => $userId,

        'id_komoditas_unggulan' =>
            $validated['id_komoditas_unggulan'],

        'id_komoditas_pembanding' =>
            $validated['id_komoditas_pembanding'],

        'jenis_sektor' =>
            $validated['jenis_sektor'],

        'keuntungan_ei' =>
            $validated['keuntungan_ei'],

        'biaya_produksi_d0' =>
            $validated['biaya_produksi_d0'],

        'produksi_t0' =>
            $validated['produksi_t0'],

        'harga_minimal_hi' =>
            $hargaMinimalHi,

        'periode' =>
            $validated['periode'] ?? null,
    ]);

    return redirect()
        ->route(
            'perhitungan-fsa.show',
            $perhitungan->id_perhitungan
        )
        ->with(
            'success',
            'Perhitungan FSA berhasil dilakukan.'
        );
}

    public function show($id)
{
    $query = PerhitunganFsa::with([
        'user',
        'komoditasUnggulan',
        'komoditasPembanding',
    ]);

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $perhitungan = $query->findOrFail($id);

    return view(
        'perhitungan_fsa.show',
        compact('perhitungan')
    );
}

    public function destroy($id)
{
    abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk menghapus data FSA.'
    );

    $perhitungan = PerhitunganFsa::findOrFail($id);

    $perhitungan->delete();

    return redirect()
        ->route('perhitungan-fsa.index')
        ->with(
            'success',
            'Data perhitungan FSA berhasil dihapus.'
        );
}
}