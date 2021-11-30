<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Models\ShoppingCart;
use App\Models\Category;
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
    Route::delete('/product/{product}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('/product/{product}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/product/{product}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/product/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/product', [AdminController::class, 'store'])->name('admin.store');
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

    $new = Product::orderByDesc('updated_at')
                    ->take(10)
                    ->get();

    $categories = Category::all();

    return view('layout.index', compact('new', $new, 'categories', $categories));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
