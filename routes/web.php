<?php

use App\Http\Controllers\BobotKriteriaController;
use App\Http\Controllers\DataWargaController;
use App\Http\Controllers\HasilPerhitunganController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\KriteriaWargaController;
use App\Http\Controllers\PerangkinganController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\UserController;
use App\Models\Subkriteria;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::resource('/warga', DataWargaController::class)->names('warga');
Route::resource('/kriteria', KriteriaController::class)->names('kriteria');
Route::resource('/subkriteria', SubkriteriaController::class)->names('subkriteria');
Route::get('/perhitungan-ahp', [BobotKriteriaController::class, 'index'])->name('perhitungan-ahp');
Route::post('/perhitungan-ahp', [BobotKriteriaController::class, 'store'])->name('perhitungan-ahp.store');
Route::get('/hasil-perhitungan', [HasilPerhitunganController::class, 'index'])->name('hasil-perhitungan');
Route::resource('/kriteria-warga', KriteriaWargaController::class)->names('kriteria-warga');
Route::get('/perangkingan', [PerangkinganController::class, 'index'])->name('perangkingan');
Route::resource('/operator', UserController::class)->names('operator');
