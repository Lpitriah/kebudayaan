<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SanggarController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\VerifikasiController;
use App\Imports\SanggarImport;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'indexLogin'])->name('auth.login');
Route::post('/login_proses', [LoginController::class, 'proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'Register'])->name('auth.register');
Route::post('/register', [LoginController::class, 'storeRegister'])->name('auth.register.store');
Route::get('/sanggar/download/pdf', [SanggarController::class, 'downloadPDF'])->name('sanggar.download.pdf');


/*
|--------------------------------------------------------------------------
| ROUTES UNTUK SEMUA USER TER-AUTH (SINGLE DASHBOARD)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Satu dashboard bersama untuk admin & user (controller akan menyesuaikan isi berdasarkan level)
    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard.index');

    // User (authenticated) dapat melihat daftar sanggar dan detailnya
    Route::get('/sanggar', [SanggarController::class, 'index'])->name('sanggar.index');
    Route::get('/sanggar/{sanggar}', [SanggarController::class, 'show'])->name('sanggar.show');

    Route::resource('daftar', DaftarController::class);

    // Update status (tambahan manual)
    Route::put('/daftar/{id}/status', [DaftarController::class, 'updateStatus'])->name('daftar.updateStatus');

    // Download PDF daftar
   // Download PDF daftar berdasarkan ID
Route::get('/pdf/daftar/{id}', [DaftarController::class, 'cetakBukti'])->name('daftar.pdf');


});

/*
|--------------------------------------------------------------------------
| ROUTES KHUSUS ADMIN (CREATE / EDIT / DELETE SANGGAR)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // resource admin (membuat /sanggar/create)
Route::resource('sanggar', SanggarController::class)->only(['index','create','store','destroy','edit']);

// kemudian route show generic (jika mau)
Route::get('/sanggar/{sanggar}', [SanggarController::class, 'show'])->whereNumber('sanggar')->name('sanggar.show');

    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::get('/verifikasi/{id}', [VerifikasiController::class, 'edit'])->name('verifikasi.edit');
    Route::get('/verifikasi/{id}', [VerifikasiController::class, 'show'])->name('verifikasi.show');
    Route::post('/verifikasi/{id}/update-status', [VerifikasiController::class, 'updateStatus'])->name('verifikasi.updateStatus');
    Route::put('/verifikasi/{id}/update-nomor', [VerifikasiController::class, 'updateNomor'])->name('verifikasi.updateNomor');
    Route::post('/sanggar/import', [SanggarController::class, 'importExcel'])->name('sanggar.import');
    Route::delete('/sanggar/{id}', [SanggarController::class, 'destroy'])->name('sanggar.destroy');
    Route::post('/sanggar/import', [SanggarController::class, 'importExcel'])->name('sanggar.import');
    Route::get('/sanggar/clear-preview', [SanggarController::class, 'clearImportPreview'])->name('sanggar.clearImportPreview');
    Route::get('/sanggar/export-excel', [SanggarController::class, 'exportExcel'])->name('sanggar.exportExcel');
});