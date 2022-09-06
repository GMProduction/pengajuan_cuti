<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AbsensiKaryawanController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanPesananController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\MasterPelangganController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\UserController;
use App\Models\PengajuanCuti;
use Illuminate\Support\Facades\Route;

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

Route::get(
    '/admin',
    function () {
        return view('login.beranda');
    }
);

Route::get(
    '/admin/user',
    function () {
        return view('admin.user');
    }
);

Route::get('admin/cetak/{id}', [PengajuanCutiController::class, 'cetakLaporan']);

Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(
    function () {
        Route::get('', [BerandaController::class, 'index']);
        Route::prefix('karyawan')->group(
            function () {
                Route::match(['POST', 'GET'], '', [KaryawanController::class, 'index']);
                Route::get('datatable', [KaryawanController::class, 'datatable']);
                Route::post('delete/{id}', [KaryawanController::class, 'destroy']);
                Route::post('resete-cuti', [KaryawanController::class, 'reseteCuti'])->middleware(\App\Http\Middleware\PimpinanMiddleware::class);
            }
        );

        Route::get('count-worker', [BerandaController::class, 'dataKaryawan']);
        Route::get('count-off', [BerandaController::class, 'dataKaryawanCuti']);
        Route::prefix("pengajuan-cuti")->middleware(\App\Http\Middleware\PimpinanMiddleware::class)->group(
            function () {
                Route::get('', [\App\Http\Controllers\PengajuanCutiController::class, 'index']);
                Route::match(['POST', 'GET'], '/{id}', [\App\Http\Controllers\PengajuanCutiController::class, 'detailCuti']);
            }
        );
    }
);

Route::prefix('karyawan')->group(
    function () {
        Route::match(['POST', 'GET'], '', [\App\Http\Controllers\Karyawan\KaryawanController::class, 'index'])->middleware(\App\Http\Middleware\KaryawanMiddleware::class);
        Route::get('profil', [\App\Http\Controllers\Karyawan\ProfileController::class, 'index'])->middleware(\App\Http\Middleware\KaryawanMiddleware::class);
    }
);

Route::match(['POST', 'GET'], '/', [LoginController::class, 'index'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

