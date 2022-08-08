<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
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
Route::get('/', [IndexController::class, 'index']);

//TuttiFrutti.com/products
Route::get('/products', [ProductController::class, 'index']);

//TuttiFrutti.com/products/Manzana
Route::get('/products/{product}', [ProductController::class, 'show']);

Auth::routes();

//TuttiFrutti.com/products/Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//ADMIN

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/admin/compras/index', [AdminController::class, 'comprasIndex']);

Route::get('/admin/compras/create', [AdminController::class, 'comprasCreate']);

Route::get('/admin/products/create', [ProductController::class, 'create']);

Route::get('/admin/products/index', [ProductController::class, 'index']);

Route::post('/', [ProductController::class, 'store']);