<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

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
//Escucha una ruta ("https://www.TuttiFrutti.com/) y utiliza un Controlador para devolver una vista
Auth::routes();



//TuttiFrutti.com/products

//TuttiFrutti.com/products/Manzana
Route::get('/products/{product}', [ProductController::class, 'show']);



//TuttiFrutti.com/products/Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//ADMIN
Route::resource('', IndexController::class)->only([
    'index'
]);
Route::resource('admin', AdminController::class)->only([
    'index'
])->middleware('auth');
Route::resource('purchases', PurchaseController::class)->middleware('auth');
Route::resource('suppliers', PurchaseController::class)->middleware('auth');

Route::resource('products', ProductController::class)->only([
    'index'
]);
Route::resource('admin/products', ProductController::class);
// Route::resource('admin.');

// ('/admin/purchases/index', [AdminController::class, 'purchasesIndex'])->name('admin.purchases');

// Route::get('/admin/purchases/{purchase}', [AdminController::class, 'purchasesShow']);

// Route::get('/admin/purchases/create', [AdminController::class, 'purchasesCreate']);

// Route::get('/admin/products/create', [ProductController::class, 'create']);

// Route::get('/admin/products/index', [AdminController::class, 'productsIndex']);

Route::post('/', [ProductController::class, 'store']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
