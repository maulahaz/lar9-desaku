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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
//--To be deleted:
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\TugasController;
use App\Http\Controllers\Admin\KursusController;
use App\Http\Controllers\TugasExecController;
//
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//====================HOME PAGE==================================================
//--Homepage:
Route::get('/', [HomeController::class, 'index']);

//--Member login:
// Route::get('auth/signin', 'Auth\LoginController@index');
// Route::get('auth/signout', 'Auth\LogoutController@store');

//====================ADMIN PAGE==================================================

//--AUTH:
Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'submit_login'])->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'submit_register']);
Route::get('forgot', [AuthController::class, 'forgot']);

//--ACCOUNT:
Route::get('account/dashboard', [AccountController::class, 'dashboard']);
Route::get('account/profile', [AccountController::class, 'profile']);
Route::post('account/update/{id}', [AccountController::class, 'update']);
Route::put('account/upload-picture/{id}', [AccountController::class, 'uploadFile']);
Route::delete('account/delete-picture/{id}', [AccountController::class, 'removeFile']);
Route::match(['GET','POST'],'account/changepass', [AccountController::class, 'changepass']);

//--DASHBOARD:
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

//--PAGE:
Route::get('/undercon', [PageController::class, 'undercon']);

//--USER:
Route::post('/admin/user/update-status-user', [UserController::class, 'updateStatusUser']);
Route::get('/admin/user/hapus/{id}', [UserController::class, 'hapus']);
// Route::get('/admin/user/{id}/detail', [UserController::class, 'detail']);
// Route::resource('admin/user', UserController::class);
Route::get('/admin/user/reset-password/{id}', [UserController::class, 'resetPassword']);

//--ADMIN:
Route::prefix('admin')->name('admin.')->group(function () {
    //--USER:
    Route::resource('user', UserController::class);
    //--Penduduk:
    Route::get('penduduk/doc-data-warga', [PendudukController::class, 'docDataWarga'])->name('penduduk.doc-data-warga');
    Route::resource('penduduk', PendudukController::class);
    Route::get('penduduk/{id}/doc-suket-warga', [PendudukController::class, 'docSuketWarga'])->name('penduduk.doc-suket-warga');
    Route::get('penduduk/{id}/get-suket-warga', [PendudukController::class, 'downloadSuketWarga'])->name('penduduk.get-suket-warga');
    //--Kelahiran:
    Route::resource('kelahiran', KelahiranController::class);
    //--Kematian:
    Route::resource('kematian', KematianController::class);
    //--Perpindahan:
    Route::resource('perpindahan', PerpindahanController::class);
    //--Keuangan:
    Route::resource('keuangan', KeuanganController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/config', [ConfigController::class, 'index'])->name('admin.config');
    Route::get('/admin/config/{id}/edit', [ConfigController::class, 'edit'])->name('admin.config.edit');
    Route::put('/admin/config/{id}', [ConfigController::class, 'update'])->name('admin.config.update');
});

// Route::get('admin/penduduk/{id}/doc', 'PendudukController@personalDoc')->name('admin.penduduk.doc');

//--MATERI:
// Route::put('/admin/materi/uploadfile/{id}', [MateriController::class, 'uploadFile']);
Route::put('/admin/materi/upload-picture/{id}', [MateriController::class, 'uploadFile']);
Route::delete('/admin/materi/delete-picture/{id}', [MateriController::class, 'removeFile']);
Route::resource('admin/materi', MateriController::class);

//--KURSUS:
Route::put('/admin/kursus/upload-picture/{id}', [KursusController::class, 'uploadFile']);
Route::delete('/admin/kursus/delete-picture/{id}', [KursusController::class, 'removeFile']);
Route::resource('admin/kursus', KursusController::class);

//--TUGAS:
Route::get('admin/tugas/{tugasId}/check', [TugasController::class, 'check']);
Route::resource('admin/tugas', TugasController::class);

//--TUGAS Execution:
Route::get('tugas-exec', [TugasExecController::class, 'index']);
Route::get('tugas-exec/create', [TugasExecController::class, 'create']);
// Route::get('tugas-exec/create/{tugasId}', [TugasExecController::class, 'createTugasExecution']);
Route::match(['get','post'],'tugas-exec/create/{tugasId}', [TugasExecController::class, 'createTugasExecution']);
Route::get('tugas-exec/{id}', [TugasExecController::class, 'show']);
Route::get('tugas-exec/{id}/edit', [TugasExecController::class, 'edit']);
// Route::get('tugas-exec/{exeId}/edit/{tgId}', [TugasExecController::class, 'edit']);
Route::post('tugas-exec/update/{tugasId}', [TugasExecController::class, 'updateTugasExecution']);
Route::post('tugas-exec/upload-file/{id}', [TugasExecController::class, 'uploadFile']);
Route::delete('tugas-exec/delete-file/{id}', [TugasExecController::class, 'removeFile']);
