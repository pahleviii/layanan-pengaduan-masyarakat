<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TransparencyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/lapor', [ComplaintController::class, 'create'])->name('lapor');
Route::post('/lapor', [ComplaintController::class, 'store'])->name('lapor.store');
Route::get('/lapor/sukses/{ticket}', [ComplaintController::class, 'success'])->name('lapor.sukses');

Route::get('/lacak', [TrackingController::class, 'index'])->name('lacak');
Route::get('/lacak/{ticket}', [TrackingController::class, 'show'])->name('lacak.show');

Route::get('/transparansi', [TransparencyController::class, 'index'])->name('transparansi');

Route::get('/tentang', [InfoController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [InfoController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [InfoController::class, 'kirimPesan'])->name('kontak.kirim');
Route::get('/faq', [InfoController::class, 'faq'])->name('faq');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/pengaduan', [AdminComplaintController::class, 'index'])->name('pengaduan.index');
        Route::delete('/pengaduan/bulk', [AdminComplaintController::class, 'bulkDestroy'])->name('pengaduan.bulk-destroy');
        Route::get('/pengaduan/{ticket}', [AdminComplaintController::class, 'show'])->name('pengaduan.show');
        Route::put('/pengaduan/{ticket}', [AdminComplaintController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{ticket}', [AdminComplaintController::class, 'destroy'])->name('pengaduan.destroy');
    });
});
