<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\KtpController;

// Route default yang mengarahkan ke Kartu Keluarga
Route::get('/', [KartuKeluargaController::class, 'index'])->name('home');

// Route untuk Kartu Keluarga
Route::resource('kartu-keluarga', KartuKeluargaController::class);

Route::resource('ktp', KtpController::class);
