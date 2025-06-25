<?php

use App\Http\Controllers\ProductsShipmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifCertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/downloadfileservlet/download', [VerifCertificateController::class, 'showByUDIN']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [VerifCertificateController::class, 'index'])->name('dashboard');
    Route::resource('/verif-certificates', VerifCertificateController::class)->except(['show', 'index']);
    Route::resource('/products-shipment', ProductsShipmentController::class);

    Route::get('/certificates/{UDIN}/qr', [VerifCertificateController::class, 'showQR'])->name('certificates.qr');
});



require __DIR__ . '/auth.php';
