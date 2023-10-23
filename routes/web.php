<?php

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
    return view('welcome');
});

Route::get('/auth/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);

Auth::routes();

//auth
Route::group(['middleware' => ['auth', 'level:admin']], function(){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'level:pelanggan']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
}); 

// dashboard admin
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);

Route::get('/adminproduk/json', [\App\Http\Controllers\AdminProdukController::class, 'data'])->name('adminproduk');
Route::get('/adminproduk', [\App\Http\Controllers\AdminProdukController::class, 'index']);

Route::get('/adminpesanan/json', [\App\Http\Controllers\PesanController::class, 'pesanan'])->name('adminpesanan');
Route::get('/adminpesanan', [\App\Http\Controllers\PesanController::class, 'adminpesanan']);

Route::get('/adminuser/json', [\App\Http\Controllers\ProfilController::class, 'user'])->name('adminpesanan');
Route::get('/adminuser', [\App\Http\Controllers\ProfilController::class, 'adminuser']);

Route::post('/simpan-data-adminproduk', [App\Http\Controllers\AdminProdukController::class, 'simpan']);
Route::get('{id}/edit-produk', [App\Http\Controllers\AdminProdukController::class, 'edit']);
Route::post('update-produk/{id}', [App\Http\Controllers\AdminProdukController::class, 'update']);
Route::get('{id}/hapus-produk', [App\Http\Controllers\AdminProdukController::class, 'hapus']);

Route::get('/adminongkir',[\App\Http\Controllers\AdminProdukController::class, 'adminongkir'])->name('adminongkir');
Route::POST('/adminongkir-simpan', [\App\Http\Controllers\AdminProdukController::class, 'adminongkirsimpan'])->name('adminongkirsimpan');

// pengunjung
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'produk']);

Route::get('/produk', [App\Http\Controllers\ProdukController::class, 'index']);
Route::post('/pesanan-simpan', [App\Http\Controllers\PesanController::class, 'simpanpesanan']);
Route::get('/pesanan', [App\Http\Controllers\PesanController::class, 'index']);

Route::get('/ongkir',[\App\Http\Controllers\ProdukController::class, 'ongkir'])->name('ongkir');
Route::POST('/ongkir-simpan', [\App\Http\Controllers\ProdukController::class, 'ongkirsimpan'])->name('ongkirsimpan');

Route::get('editprofil', [\App\Http\Controllers\ProfilController::class, 'index']);
Route::patch('updateprofil/{id}', [\App\Http\Controllers\ProfilController::class, 'update'])->name('update');