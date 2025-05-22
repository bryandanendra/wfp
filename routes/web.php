<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KategoriAdminController;
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
    $categories = \App\Models\Category::all();
    $foods = \App\Models\Food::all();
    return view('index', ['categories' => $categories, 'foods' => $foods]);
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
    Route::get('/dashboard', [OrderController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('categories', KategoriAdminController::class);
    
    Route::get('/reports', [OrderController::class, 'reports'])->name('reports');
    
    Route::resource('food', FoodController::class);
    Route::resource('members', MemberController::class);
    Route::resource('orders', OrderController::class);
});

// Route untuk CRUD dengan Ajax dan Modal untuk Kategori
Route::post('/ajax/category/getEditForm', [KategoriAdminController::class, 'getEditForm'])->name('kategori.getEditForm');
Route::post('/ajax/category/getEditFormB', [KategoriAdminController::class, 'getEditFormB'])->name('kategori.getEditFormB');
Route::post('/ajax/category/saveDataUpdate', [KategoriAdminController::class, 'saveDataUpdate'])->name('kategori.saveDataUpdate');
Route::post('/ajax/category/deleteData', [KategoriAdminController::class, 'deleteData'])->name('kategori.deleteData');

// Route untuk CRUD dengan Ajax dan Modal untuk Food
Route::post('/ajax/food/getEditForm', [FoodController::class, 'getEditForm'])->name('food.getEditForm');
Route::post('/ajax/food/getEditFormB', [FoodController::class, 'getEditFormB'])->name('food.getEditFormB');
Route::post('/ajax/food/saveDataUpdate', [FoodController::class, 'saveDataUpdate'])->name('food.saveDataUpdate');
Route::post('/ajax/food/deleteData', [FoodController::class, 'deleteData'])->name('food.deleteData');

// Route untuk CRUD dengan Ajax dan Modal untuk Order
Route::post('/ajax/orders/getEditForm', [OrderController::class, 'getEditForm'])->name('orders.getEditForm');
Route::post('/ajax/orders/getEditFormB', [OrderController::class, 'getEditFormB'])->name('orders.getEditFormB');
Route::post('/ajax/orders/saveDataUpdate', [OrderController::class, 'saveDataUpdate'])->name('orders.saveDataUpdate');
Route::post('/ajax/orders/deleteData', [OrderController::class, 'deleteData'])->name('orders.deleteData');

Route::get('/food/{id}', function ($id) {
    $food = \App\Models\Food::findOrFail($id);
    return view('food.detail', ['food' => $food]);
})->name('food.detail');

// Route::resource('food',FoodController::class);