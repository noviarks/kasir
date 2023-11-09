<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HapusTransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/', [HomeController::class, 'index']);

//Login
Route::get('/', [AuthController::class, 'index'])->name('/');
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'checkRole:admin']], function(){
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);

    Route::get('/jenis-barang', [JenisBarangController::class, 'index']);
    Route::post('/jenis-barang/store', [JenisBarangController::class, 'store']);
    Route::post('/jenis-barang/update/{id}', [JenisBarangController::class, 'update']);
    Route::get('/jenis-barang/destroy/{id}', [JenisBarangController::class, 'destroy']);

    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/update/{id}', [BarangController::class, 'update']);
    Route::get('/barang/destroy/{id}', [BarangController::class, 'destroy']);

    Route::get('/hapus-transaksi', [HapusTransaksiController::class, 'index']);
    Route::get('/hapus-transaksi/detail/{id}', [HapusTransaksiController::class, 'detail']);

    Route::get('/laporan/transaksi', [LaporanController::class, 'transaksi']);
    Route::post('/laporan/export-transaksi', [LaporanController::class, 'exportTransaksi']);
});

Route::group(['middleware' => ['auth', 'checkRole:kasir']], function(){
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);
    Route::post('/transaksi/get-detail-barang', [TransaksiController::class, 'getDetailBarang']);
    Route::post('/transaksi/add-to-cart', [TransaksiController::class, 'addToCart']);
    Route::post('/transaksi/update-cart', [TransaksiController::class, 'updateCart']);
    Route::get('/transaksi/delete-cart/{id}', [TransaksiController::class, 'deleteCart']);
    Route::post('/transaksi/store', [TransaksiController::class, 'store']);
    Route::get('/transaksi/destroy/{id}', [TransaksiController::class, 'destroy']);
    Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail']);
    Route::get('/transaksi/cetak/{id}', [TransaksiController::class, 'cetak']);
});

Route::group(['middleware' => ['auth', 'checkRole:admin,kasir']], function(){
    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/update/{id}', [ProfileController::class, 'update']);
});