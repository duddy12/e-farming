<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PerhitunganFsa;
use App\Models\PenilaianLahan;
use App\Models\Kelayakan;
use App\Models\Solusi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->isSuperAdmin()) {

            // Data seluruh petani untuk Superadmin
            $totalPetani = User::where('role', 'user')->count();

            $totalFsa = PerhitunganFsa::count();

            $totalPenilaian = PenilaianLahan::count();

            $totalKelayakan = Kelayakan::count();

            $totalSolusi = Solusi::count();

        } else {

            // Data milik user/petani yang sedang login
            $userId = Auth::id();

            $totalPetani = null;

            $totalFsa = PerhitunganFsa::where(
                'id_user',
                $userId
            )->count();

            $totalPenilaian = PenilaianLahan::where(
                'id_user',
                $userId
            )->count();

            $totalKelayakan = Kelayakan::where(
                'id_user',
                $userId
            )->count();

            $totalSolusi = Solusi::where(
                'id_user',
                $userId
            )->count();
        }

        return view(
            'dashboard',
            compact(
                'totalPetani',
                'totalFsa',
                'totalPenilaian',
                'totalKelayakan',
                'totalSolusi'
            )
        );
    }
}