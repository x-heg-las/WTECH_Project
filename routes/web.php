<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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
    $products = Product::all();
    return view('layout.index', compact('products', $products));
});

Route::get('/login', function (){
    return view('auth.login');
});

Route::get('/shopping_cart', function () {
    return view('layout.shopping-cart');
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('show');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
