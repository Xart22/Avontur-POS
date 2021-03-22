<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\AkunControllers;
use App\Http\Controllers\ProdukControllers;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\LaporanControllers;


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
//AUTH
Route::get('/',[AuthLoginController::class,'index'])->name('login');
Route::post('/authlogin',[AuthLoginController::class,'login'])->name('auth.login');




//Daboard

Route::middleware(['CheckAuth'])->group(function () {
    Route::get('/dashboard', [HomeControllers::class,'index'])->name('dashboard');
    Route::get('/authlogout',[AuthLoginController::class,'logout'])->name('auth.logout');
    Route::post('/addTempCart/{id}',[HomeControllers::class,'addTempCart'])->name('addTempCart');
    Route::post('/tambahqty/{id}',[HomeControllers::class,'tambahqty'])->name('tambahqty');
    Route::post('/kurangqty/{id}',[HomeControllers::class,'kurangqty'])->name('kurangqty');
    Route::get('/deleteall',[HomeControllers::class,'deleteall'])->name('deleteall');
    Route::post('/addlaporan',[HomeControllers::class,'addlaporan'])->name('addlaporan');
    Route::get('/detailreport/{id}',[LaporanControllers::class,'detail'] )->name('detailreport');
    Route::get('/report/harian',[LaporanControllers::class,'index'] );
    Route::get('/report/bulanan',[LaporanControllers::class,'bulanan'] );


});
//admin
Route::middleware(['CheckAuth', 'IsAdmin'])->group(function () {
    //produk
    Route::get('/produk',[ProdukControllers::class,'index'] );
    Route::get('/produk/{id}',[ProdukControllers::class,'detailProduk'] )->name('detailproduk');
    Route::post('/addProduk',[ProdukControllers::class,'addProduk'])->name('addproduk');
    Route::post('/deleteProduk',[ProdukControllers::class,'deleteProduk'])->name('deleteProduk');
    Route::post('/updateProduk',[ProdukControllers::class,'updateProduk'])->name('updateProduk');

    //akun
    
    Route::get('/akun',[AkunControllers::class,'index'] );
    Route::post('/addAkun',[AkunControllers::class,'addAkun'])->name('addakun');
    Route::get('/akun/{id}',[AkunControllers::class,'detailAkun'] )->name('akun');
    Route::post('/deleteakun',[AkunControllers::class,'deleteAkun'])->name('deleteakun');
    Route::post('/updateakun',[AkunControllers::class,'updateAkun'])->name('updateakun');

    // LAPORAN

    Route::post('/deletelaporan',[LaporanControllers::class,'delete'])->name('deletelaporan');
});