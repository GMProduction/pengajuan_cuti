<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanPesananController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\MasterPelangganController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('login.beranda');
});


Route::get('/admin/user', function () {
    return view('admin.user');
});

Route::prefix('admin')->group(function (){
    Route::get('', [BerandaController::class, 'index']);
    Route::prefix('karyawan')->group(function (){
        Route::match(['POST','GET'],'', [KaryawanController::class, 'index']);
        Route::get('datatable', [KaryawanController::class, 'datatable']);
    });
    Route::get('pengajuan-cuti', [\App\Http\Controllers\PengajuanCutiController::class, 'index']);

});

Route::get('/admin/beranda', [BerandaController::class, 'index']);
Route::get('/admin/user', [UserController::class, 'index']);
Route::get('/admin/barang', [BarangController::class, 'index']);
Route::get('/admin/transaksi/cetak/{id}', [TransaksiController::class, 'cetakLaporan']);
Route::get('/admin/laporanpesanan', [LaporanPesananController::class, 'index']);
Route::get('/admin/masterbarang', [MasterBarangController::class, 'index']);
Route::get('/admin/masterpelanggan', [MasterPelangganController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::get('/daftar', [DaftarController::class, 'index']);
Route::post('/daftar', [DaftarController::class, 'store']);
