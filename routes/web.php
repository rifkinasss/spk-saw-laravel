<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPKController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [SPKController::class, 'index'])->name('dashboard');

// Criteria Routes
Route::get('/dashboard/criteria', [SPKController::class, 'index_criteria'])->name('dashboard.criteria');
Route::post('/dashboard/criteria', [SPKController::class, 'store_criteria'])->name('dashboard.store-criteria');
Route::put('/dashboard/criteria/{id}', [SPKController::class, 'update'])->name('dashboard.update-criteria');
Route::delete('/dashboard/criteria/{id}', [SPKController::class, 'destroy_criteria'])->name(name: 'dashboard.destroy-criteria');

// Sub-Criteria Routes
Route::get('/dashboard/sub-criteria', [SPKController::class, 'index_sub_criteria'])->name('dashboard.sub-criteria');
Route::post('/dashboard/sub-criteria', [SPKController::class, 'store_sub_criteria'])->name('dashboard.store-sub-criteria');
Route::put('/dashboard/sub-criteria/{id}', [SPKController::class, 'update_sub_criteria'])->name('dashboard.update-sub-criteria');
Route::delete('/dashboard/sub-criteria/{id}', [SPKController::class, 'destroy_sub_criteria'])->name('dashboard.destroy-sub-criteria');

// Alternatif Routes
Route::get('/dashboard/alternatif', [SPKController::class, 'index_alternatif'])->name('dashboard.alternatif');
Route::post('/dashboard/alternatif', [SPKController::class, 'store_alternatif'])->name('dashboard.store-alternatif');
Route::put('/dashboard/alternatif/{id}', [SPKController::class, 'update_alternatif'])->name('dashboard.update-alternatif');
Route::delete('/dashboard/alternatif/{id}', [SPKController::class, 'destroy_alternatif'])->name('dashboard.destroy-alternatif');

// Routes untuk Dataset
Route::get('/dashboard/dataset', [SPKController::class, 'index_dataset'])->name('dashboard.dataset');
Route::post('/dashboar/dataset', [SPKController::class, 'store_dataset'])->name('dataset.store');
Route::put('/dashboard/dataset/{id}', [SPKController::class, 'update_dataset'])->name('dataset.update');
Route::delete('/dashboard/dataset/{id}', [SPKController::class, 'destroy_dataset'])->name('dataset.destroy');

// Routes untuk Normalisasi Dataset
Route::get('/dashboard/normalisasi', [SPKController::class, 'index_normalisasi'])->name('dashboard.normalisasi');
Route::post('/dashboard/normalisasi/process', [SPKController::class, 'normalisasi_dataset'])->name('normalisasi.process');

// Routes untuk Konversi Dataset
Route::get('/dashboard/konversi', [SPKController::class, 'index_konversi'])->name('dashboard.konversi');
Route::post('/dashboard/konversi/process', [SPKController::class, 'konversi_dataset'])->name('konversi.process');

// Routes untuk Perankingan
Route::get('dashboard/hasil-saw', [SPKController::class, 'hasilSAW'])->name('dashboard.hasil');
