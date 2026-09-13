<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\PerhitunganFsaController;
use App\Http\Controllers\PenilaianLahanController;
use App\Http\Controllers\KelayakanController;
use App\Http\Controllers\SiklusController;
use App\Http\Controllers\SolusiController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {

    
    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::resource('users', UserController::class);
    
    Route::delete(
    '/siklus-evidence/{evidence}',
    [SiklusController::class, 'destroyEvidence']
)->name('siklus.evidence.destroy');

    Route::resource(
        'perhitungan-fsa',
        PerhitunganFsaController::class
    )->only([
        'index',
        'create',
        'store',
        'show',
        'destroy',
    ]);
    Route::resource('komoditas', KomoditasController::class)->except(['show',]);
    Route::resource('penilaian-lahan', PenilaianLahanController::class)->except(['show',]);
    Route::resource('kelayakan', KelayakanController::class)->except(['show',]);
    Route::resource('siklus', SiklusController::class)->except(['show',]);
    Route::resource('solusi', SolusiController::class)->except(['show',]);
    Route::get('/analisis',[AnalisisController::class, 'index'])->name('analisis.index');

});

//Route::get('/login',function(){

//    return view('login');
//});

