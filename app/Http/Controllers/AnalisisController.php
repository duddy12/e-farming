<?php

namespace App\Http\Controllers;

use App\Models\PerhitunganFsa;
use App\Models\PenilaianLahan;
use App\Models\Kelayakan;
use App\Models\Solusi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AnalisisController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $petani = Auth::user();

         if (Auth::user()->isSuperAdmin()) {
            $userId = request('id_user');
            $petani = null;

            if ($userId) {
                $petani = User::where(
                    'role',
                    'user'
                )
                ->where(
                    'id_user',
                    $userId
                )
                ->first();

                if (!$petani) {
                    $userId = null;
                }
            }
         }
 
         $perhitunganFsa = null;
         $penilaianLahan = null;
         $kelayakan = null;
         $solusi = collect();

         if ($userId) {

            $perhitunganFsa = PerhitunganFsa::with([
                'komoditasUnggulan',
                'komoditasPembanding',
                'user',
            ])
            ->where(
                'id_user',
                $userId
            )
            ->orderBy(
                'id_perhitungan',
                'desc'
            )
            ->first();

            

            $kelayakan = Kelayakan::with([
            'user',
            'penilaianLahan',
            'presentasi',
            ])
            ->where(
            'id_user',
                $userId
            )
            ->orderBy(
            'id_kelayakan',
            'desc'
            )
            ->first();


            if ($kelayakan) {

            $penilaianLahan =
            $kelayakan->penilaianLahan;

            } else {

            $penilaianLahan = PenilaianLahan::with('user')
            ->where(
            'id_user',
            $userId
                )
                ->orderBy(
            'id_penilaian',
            'desc'
                )
                ->first();
            }

            $solusi = Solusi::with('user')
             ->where(
              'id_user',
             $userId
              )
             ->orderBy(
            'id_solusi',
               'desc'
                )
             ->get();

        }

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
            'analisis.index',
            compact(
                'perhitunganFsa',
                'penilaianLahan',
                'kelayakan',
                'solusi',
                'userId',
                'petani',
                'daftarUser'
            )
        );
    }
}