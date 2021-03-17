<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\AkunControllers;
use App\Http\Controllers\ProdukControllers;
use App\Http\Controllers\HomeControllers;


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
Route::get('/',[AuthLoginController::class,'index']);
Route::post('Authlogin',[AuthLoginController::class,'login'])->name('auth.login');




//Daboard

Route::middleware(['CheckAuth'])->group(function () {
    Route::get('/dashboard', [HomeControllers::class,'index']);
    Route::get('Authlogout',[AuthLoginController::class,'logout'])->name('auth.logout');
    Route::post('addTempCart/{id}',[HomeControllers::class,'addTempCart'])->name('addTempCart');
    Route::post('tambahqty/{id}',[HomeControllers::class,'tambahqty'])->name('tambahqty');
    Route::post('kurangqty/{id}',[HomeControllers::class,'kurangqty'])->name('kurangqty');

});
//admin
Route::middleware(['CheckAuth', 'IsAdmin'])->group(function () {
    //produk
    Route::get('/produk',[ProdukControllers::class,'index'] );
    Route::get('/produk/{id}',[ProdukControllers::class,'detailProduk'] );
    Route::post('addProduk',[ProdukControllers::class,'addProduk'])->name('addproduk');
    Route::post('deleteProduk',[ProdukControllers::class,'deleteProduk'])->name('deleteProduk');
    Route::post('updateProduk',[ProdukControllers::class,'updateProduk'])->name('updateProduk');

    //akun
    
    Route::get('/akun',[AkunControllers::class,'index'] );
    Route::post('addAkun',[AkunControllers::class,'addAkun'])->name('addakun');
    Route::get('/akun/{id}',[AkunControllers::class,'detailAkun'] );
    Route::post('deleteakun',[AkunControllers::class,'deleteAkun'])->name('deleteakun');
    Route::post('updateakun',[AkunControllers::class,'updateAkun'])->name('updateakun');
});