<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;


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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\BarangController;
Route::resource('barang',BarangController::class)->middleware('auth');
// Route::put('/barang/{id}', 'BarangController@update')->name('barang.update');

use App\Http\Controllers\KategoriController;
Route::resource('kategori',KategoriController::class)->middleware('auth');

use App\Http\Controllers\LoginController;
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class,'authenticate']);
Route::post('logout', [LoginController::class,'logout']);
Route::get('logout', [LoginController::class,'logout']);


use App\Http\Controllers\RegisterController;
// Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class,'store']);
Route::get('/register', [RegisterController::class,'create']);
Route::post('register', [RegisterController::class,'store']);
Route::get('/dashboard',[DashboardController::class,'index']);


Route::resource('vbarangmasuk',BarangMasukController::class);
Route::resource('vbarangkeluar',BarangKeluarController::class);
