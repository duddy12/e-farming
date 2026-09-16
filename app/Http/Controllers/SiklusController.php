<?php

namespace App\Http\Controllers;

use App\Models\Siklus;
use App\Models\SiklusEvidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiklusController extends Controller
{
    public function index(Request $request)
{
    $query = Siklus::with([
        'user',
        'evidences'
    ]);

    // Petani hanya dapat melihat data miliknya sendiri
    if (!Auth::user()->isSuperAdmin()) {
        $query->where(
            'id_user',
            Auth::id()
        );
    }

    $search = trim($request->input('search', ''));

    if ($search !== '') {

        $query->where(function ($q) use ($search) {

            // Cari berdasarkan sektor
            $q->where(
                'id_sektor',
                'like',
                '%' . $search . '%'
            );

            // Cari berdasarkan periode
            $q->orWhere(
                'periode',
                'like',
                '%' . $search . '%'
            );

            // Cari berdasarkan deskripsi siklus
            $q->orWhere(
                'desc',
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

    $dataSiklus = $query
        ->orderBy(
            'id_siklus',
            'desc'
        )
        ->paginate(5);
        // Pertahankan parameter search saat pindah halaman
        $dataSiklus->appends(
        $request->only('search')
        );

    return view(
        'siklus.index',
        compact(
            'dataSiklus',
            'search'
        )
    );
}

    public function create()
    {
        
        return view('siklus.create');
    }

   public function store(Request $request)
{
   $validated = $request->validate([
    'id_sektor' => 'required',
    'periode' => 'required',
    'desc' => 'required|string',

    'foto_evidence' => 'required|array|max:6',
    'foto_evidence.*' => 'image|mimes:jpg,jpeg,png|max:5120',
]);
    $siklus = Siklus::create([
        'id_user' => Auth::id(),
        'id_sektor' => $validated['id_sektor'],
        'periode' => $validated['periode'],
        'desc' => $validated['desc'],
    ]);

    if ($request->hasFile('foto_evidence')) {

        foreach ($request->file('foto_evidence') as $index => $foto) {

            $namaFile = 'evidence_'
                . Auth::id()
                . '_'
                . $siklus->id_siklus
                . '_'
                . time()
                . '_'
                . $index
                . '.'
                . $foto->getClientOriginalExtension();

            $foto->storeAs(
                'evidence',
                $namaFile,
                'public'
            );

            SiklusEvidence::create([
                'id_siklus' => $siklus->id_siklus,
                'id_user' => Auth::id(),
                'foto_evidence' => 'evidence/' . $namaFile,
                'tanggal_diambil' => now(),
            ]);
        }
    }

    return redirect()
        ->route('siklus.index')
        ->with(
            'success',
            'Data siklus dan evidence foto berhasil disimpan.'
        );
}

    public function edit(Siklus $siklu)
{
   $siklus = $siklu;

    if (
        !Auth::user()->isSuperAdmin() &&
        $siklus->id_user !== Auth::id()
    ) {
        abort(403, 'Anda tidak memiliki akses ke data siklus ini.');
    }

    $siklus->load([
        'user',
        'evidences'
    ]);

    return view(
        'siklus.edit',
        compact('siklus')
    );
}

   public function update(Request $request, Siklus $siklu)
{
    
    

    $siklus = $siklu;
     if (
        !Auth::user()->isSuperAdmin() &&
        $siklus->id_user !== Auth::id()
    ) {
        abort(403, 'Anda tidak memiliki akses ke data siklus ini.');
    }

    $validated = $request->validate([
        'id_sektor' => 'required',
        'periode' => 'required',
        'desc' => 'required|string',

        'foto_evidence' => 'nullable|array|max:6',
        'foto_evidence.*' => 'image|mimes:jpg,jpeg,png|max:5120',
    ]);

    $jumlahFotoLama = $siklus->evidences()->count();

    $jumlahFotoBaru = $request->hasFile('foto_evidence')
        ? count($request->file('foto_evidence'))
        : 0;

    $totalFoto = $jumlahFotoLama + $jumlahFotoBaru;

    if ($totalFoto > 6) {
        $sisaSlot = max(0, 6 - $jumlahFotoLama);

        return back()
            ->withInput()
            ->withErrors([
                'foto_evidence' =>
                    'Maksimal total evidence adalah 6 foto. ' .
                    'Saat ini sudah ada ' . $jumlahFotoLama .
                    ' foto. Anda hanya dapat menambah ' .
                    $sisaSlot . ' foto lagi.'
            ]);
    }

    $siklus->update([
        'id_sektor' => $validated['id_sektor'],
        'periode' => $validated['periode'],
        'desc' => $validated['desc'],
    ]);

    if ($request->hasFile('foto_evidence')) {

        foreach ($request->file('foto_evidence') as $index => $foto) {

            $namaFile = 'evidence_'
                . Auth::id()
                . '_'
                . $siklus->id_siklus
                . '_'
                . time()
                . '_'
                . $index
                . '.'
                . $foto->getClientOriginalExtension();

            $foto->storeAs(
                'evidence',
                $namaFile,
                'public'
            );

            SiklusEvidence::create([
                'id_siklus' => $siklus->id_siklus,
                'id_user' => Auth::id(),
                'foto_evidence' => 'evidence/' . $namaFile,
                'tanggal_diambil' => now(),
            ]);
        }
    }

    return redirect()
        ->route('siklus.index')
        ->with(
            'success',
            'Data siklus berhasil diperbarui.'
        );
}


    public function destroy($id)
{
    $siklus = Siklus::with('evidences')
        ->findOrFail($id);
        
         if (
        !Auth::user()->isSuperAdmin() &&
        $siklus->id_user !== Auth::id()
    ) {
        abort(403, 'Anda tidak memiliki akses untuk menghapus data siklus ini.');
    }

    foreach ($siklus->evidences as $evidence) {

        if (
            $evidence->foto_evidence &&
            Storage::disk('public')->exists(
                $evidence->foto_evidence
            )
        ) {
            Storage::disk('public')->delete(
                $evidence->foto_evidence
            );
        }
    }

    $siklus->delete();

    return redirect()
        ->route('siklus.index')
        ->with(
            'success',
            'Data siklus dan seluruh evidence berhasil dihapus.'
        );
}

public function destroyEvidence(SiklusEvidence $evidence)
{
    $evidence->load('siklus');

    if (
        !Auth::user()->isSuperAdmin() &&
        (int) $evidence->siklus->id_user !== (int) Auth::id()
    ) {
        abort(
            403,
            'Anda tidak memiliki akses untuk menghapus evidence ini.'
        );
    }

    if (
        $evidence->foto_evidence &&
        Storage::disk('public')->exists(
            $evidence->foto_evidence
        )
    ) {
        Storage::disk('public')->delete(
            $evidence->foto_evidence
        );
    }

    $evidence->delete();

    return back()->with(
        'success',
        'Evidence foto berhasil dihapus.'
    );
}
}