<?php

use Illuminate\Support\Facades\Route;
//--AUTH:
use App\Http\Controllers\Auth\AuthController;
//--ADMIN:
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\KelahiranController;
use App\Http\Controllers\Admin\KematianController;
use App\Http\Controllers\Admin\PerpindahanController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\ConfigController;
//--PUBLIC:
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//====================HOME PAGE==================================================
Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::post('kontak', [HomeController::class, 'storeKontak'])->name('kontak.store');

//====================AUTH=======================================================
Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'submit_login'])->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'submit_register'])->middleware('guest');
Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');

//====================ACCOUNT====================================================
Route::middleware(['auth'])->group(function () {
    Route::get('account/dashboard', [AccountController::class, 'dashboard'])->name('account.dashboard');
    Route::get('account/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('account/update/{id}', [AccountController::class, 'update']);
    Route::put('account/upload-picture/{id}', [AccountController::class, 'uploadFile']);
    Route::delete('account/delete-picture/{id}', [AccountController::class, 'removeFile']);
    Route::match(['GET', 'POST'], 'account/changepass', [AccountController::class, 'changepass']);
});

//====================ADMIN======================================================
Route::middleware(['auth', 'staff'])->group(function () {
    //--EXTRA USER ACTIONS (ADMIN ONLY):
    Route::middleware('admin')->group(function () {
        Route::post('/admin/user/update-status-user', [UserController::class, 'updateStatusUser']);
        Route::get('/admin/user/reset-password/{id}', [UserController::class, 'resetPassword']);
        Route::get('/admin/user/hapus/{id}', [UserController::class, 'hapus']);
    });

    //--ADMIN RESOURCES:
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('user', UserController::class)->middleware('admin');

        //--Penduduk:
        Route::get('penduduk/doc-data-warga', [PendudukController::class, 'docDataWarga'])->name('penduduk.doc-data-warga');
        Route::get('penduduk/{id}/doc-suket-warga', [PendudukController::class, 'docSuketWarga'])->name('penduduk.doc-suket-warga');
        Route::get('penduduk/{id}/get-suket-warga', [PendudukController::class, 'downloadSuketWarga'])->name('penduduk.get-suket-warga');
        Route::resource('penduduk', PendudukController::class);

        Route::resource('kelahiran', KelahiranController::class);
        Route::resource('kematian', KematianController::class);
        Route::resource('perpindahan', PerpindahanController::class);
        Route::resource('keuangan', KeuanganController::class);
    });
});

//--CONFIG (ADMIN ONLY):
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/config', [ConfigController::class, 'index'])->name('admin.config');
    Route::get('/admin/config/{id}/edit', [ConfigController::class, 'edit'])->name('admin.config.edit');
    Route::put('/admin/config/{id}', [ConfigController::class, 'update'])->name('admin.config.update');
});
