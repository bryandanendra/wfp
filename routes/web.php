<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\FoodController;
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

Route::get('manggil-view',function(){
    return view('felix');
});

Route::view('magic-view','magic',['nama' => 'brian']);

Route::get('parameter-tidak-maksa/{nama?}/di/{kota?}',function($nama = 'sabar ya azril', $kota = 'sby'){
    
    //return 'halo, '.$nama.' Selamat dtg di web gua!';
    return view('utama' ,['nama' => $nama,'kota' => $kota]);
});


Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/before_order', function () {
    return view('before_order');
});


Route::get('/menu/{type}', function ($type) {
    if ($type == 'dinein' || $type == 'takeaway') {
        return view('menu', ['type' => $type]);
    }
    return abort(404);
});


Route::prefix('admin')->group(function () {
    Route::get('/categories', function () {
        return view('admin.categories');
    });
    
    Route::get('/order', function () {
        return view('admin.orders');
    });
    
    Route::get('/members', function () {
        return view('admin.members');
    });
});

Route::get('daftar-kategori',[KategoriController::class,'index']);

Route::resource('food',FoodController::class);