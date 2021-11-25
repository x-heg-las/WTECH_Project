<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Models\ShoppingCart;
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

Route::prefix('admin')->middleware(['auth_admin'])->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
   });

Route::get('/shopping_cart', function () {
    return view('layout.shopping-cart');
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('show');

Route::put('/products/{product}', [ShoppingCartController::class, 'addToShoppingCart']);

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/order/store', [OrderController::class, 'store'])->name('store');

Route::get('/checkout/payment', [ShoppingCartController::class, 'choosePaymentMethod']);

Route::get('/activate/{option}/{value}/{page}', [ShoppingCartController::class, 'changeOption']);

Route::get('/checkout/shipping', [ShoppingCartController::class, 'chooseShippingMethod']);

Route::post('/shipping', [ShoppingCartController::class, 'addShippingData']);

Route::delete('/remove_item/{id}', [ShoppingCartController::class, 'removeFromShoppingCart']);

Route::get('/shopping_cart', [ShoppingCartController::class, 'index']);

Route::get('/checkout/recap', [ShoppingCartController::class, 'recapitulation']);

Route::put('/quantity/{item}', [CartItemController::class, 'update']);

Route::get('/', function () {

    $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    if (Auth::user() != null){
        $out->writeln(Auth::user()->name);
    }
    $out->writeln("------------------------------------------------------------------------------------------------");

    $products = Product::all();

    return view('layout.index', compact('products', $products));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
