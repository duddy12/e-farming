<?php

namespace App\Http\Controllers;

use App\Models\Kelayakan;
use App\Models\PenilaianLahan;
use App\Models\Presentasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class KelayakanController extends Controller
{
  public function index()
{
    $query = Kelayakan::with([
        'user',
        'penilaianLahan',
        'presentasi',
    ]);

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $dataKelayakan = $query
        ->orderBy(
            'id_kelayakan',
            'desc'
        )
        ->get();

    return view(
        'kelayakan.index',
        compact('dataKelayakan')
    );
}

    public function create(Request $request)
{
    abort_unless(
    Auth::user()->isSuperAdmin(),
    403,
    'Anda tidak memiliki akses untuk menambah data kelayakan.'
);
    $daftarUser = collect();
    $penilaianLahan = collect();

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

        $selectedUserId = $request->query('id_user');

        if ($selectedUserId) {
            $penilaianLahan = PenilaianLahan::where(
                'id_user',
                $selectedUserId
            )
            ->orderBy(
                'id_penilaian',
                'desc'
            )
            ->get();
        }

    } else {

        $selectedUserId = Auth::id();

        $penilaianLahan = PenilaianLahan::where(
            'id_user',
            $selectedUserId
        )
        ->orderBy(
            'id_penilaian',
            'desc'
        )
        ->get();
    }

    $presentasi = Presentasi::orderBy(
        'id_presentasi',
        'desc'
    )->get();

    return view(
        'kelayakan.create',
        compact(
            'daftarUser',
            'penilaianLahan',
            'presentasi',
            'selectedUserId'
        )
    );
}

    public function store(Request $request)
{
    abort_unless(
    Auth::user()->isSuperAdmin(),
    403,
    'Anda tidak memiliki akses untuk menambah data kelayakan.'
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
        'id_sektor' => [
            'required',
            'integer',
        ],

        'id_penilaian_lahan' => [
            'required',
            Rule::exists(
                'tb_penilaian_lahan',
                'id_penilaian'
            )->where(
                'id_user',
                $userId
            ),
        ],

        'id_presentasi_lahan' => [
            'required',
            'integer',
            'exists:tb_presentasi,id_presentasi',
        ],

        'hasil_kelayakan' => [
            'required',
            'string',
            'max:255',
        ],
    ]);

    $validated['id_user'] = $userId;

    Kelayakan::create($validated);

    return redirect()
        ->route('kelayakan.index')
        ->with(
            'success',
            'Data kelayakan berhasil ditambahkan.'
        );
}

   public function edit($id)
{
    abort_unless(
        Auth::user()->isSuperAdmin(),
        403,
        'Anda tidak memiliki akses untuk mengedit data.'
    );

    $kelayakan = Kelayakan::findOrFail($id);

    $penilaianLahan = PenilaianLahan::where(
        'id_user',
        $kelayakan->id_user
    )
    ->orderBy(
        'id_penilaian',
        'desc'
    )
    ->get();

    $presentasi = Presentasi::orderBy(
        'id_presentasi',
        'desc'
    )->get();

    return view(
        'kelayakan.edit',
        compact(
            'kelayakan',
            'penilaianLahan',
            'presentasi'
        )
    );
}

    public function update(Request $request, $id)
{
    
    abort_unless(
    Auth::user()->isSuperAdmin(),
    403,
    'Anda tidak memiliki akses untuk mengubah data.'
);
    $query = Kelayakan::query();

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $kelayakan = $query->findOrFail($id);

    $rules = [
        'id_sektor' => [
            'required',
            'integer',
        ],

        'id_presentasi_lahan' => [
            'required',
            'integer',
            'exists:tb_presentasi,id_presentasi',
        ],

        'hasil_kelayakan' => [
            'required',
            'string',
            'max:255',
        ],
    ];

    if (Auth::user()->isSuperAdmin()) {
        $rules['id_penilaian_lahan'] = [
            'required',
            'integer',
            Rule::exists(
                'tb_penilaian_lahan',
                'id_penilaian'
            )->where(
                'id_user',
                $kelayakan->id_user
            ),
        ];
    } else {
        $rules['id_penilaian_lahan'] = [
            'required',
            'integer',
            Rule::exists(
                'tb_penilaian_lahan',
                'id_penilaian'
            )->where(
                'id_user',
                Auth::id()
            ),
        ];
    }

    $validated = $request->validate($rules);

    $kelayakan->update($validated);

    return redirect()
        ->route('kelayakan.index')
        ->with(
            'success',
            'Data kelayakan berhasil diperbarui.'
        );
    }

   public function destroy($id)
{
    abort_unless(
    Auth::user()->isSuperAdmin(),
    403,
    'Anda tidak memiliki akses untuk menghapus data.'
);

    $query = Kelayakan::query();

    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $kelayakan = $query->findOrFail($id);

    $kelayakan->delete();

    return redirect()
        ->route('kelayakan.index')
        ->with(
            'success',
            'Data kelayakan berhasil dihapus.'
        );
}
}