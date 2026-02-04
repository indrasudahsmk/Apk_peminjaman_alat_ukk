<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\PengembalianController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::get('/logaktivitas', [LogAktivitasController::class, 'index'])->name('log.index');
    Route::post('/logaktivitas/store', [LogAktivitasController::class, 'store'])->name('log.store');
});

Route::middleware(['auth', 'checkrole:admin,petugas,peminjam'])->group(function () {
    Route::resource('/peminjaman', PeminjamanController::class);
    Route::resource('/pengembalian', PengembalianController::class);
});

Route::middleware(['auth', 'checkrole:admin,peminjam'])->group(function () {
    Route::resource('/alat', AlatController::class);
    Route::post('peminjam/pengembalian/{peminjaman}/kembalikan', [PengembalianController::class, 'kembalikan'])->name('pengembalian.kembalikan');
});

Route::middleware(['auth', 'checkrole:petugas'])->group(function () {
    Route::put('/petugas/{peminjaman}/setuju', [PeminjamanController::class, 'setuju'])->name('peminjaman.setuju');
    Route::put('/petugas/{peminjaman}/tolak', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');
    Route::get('/petugas/print', [PeminjamanController::class, 'print'])->name('peminjaman.print');
});



require __DIR__ . '/auth.php';
