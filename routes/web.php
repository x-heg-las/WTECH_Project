<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckoutLoginCheck;
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

Route::get('/products/{product}', [ProductController::class, 'show'])
                ->name('show');

Route::put('/products/{product}', [CartItemController::class, 'create'])
                ->name('addToShoppingCart');

Route::get('/search', [ProductController::class, 'search'])
                ->middleware('check_search_input')
                ->name('search');

Route::get('/order/store', [OrderController::class, 'store'])
                ->name('store_order');

Route::get('/checkout/payment', [ShoppingCartController::class, 'choosePaymentMethod'])
                ->name('payment_method');

Route::get('/activate/{option}/{value}/{page}', [ShoppingCartController::class, 'changeOption']);

Route::get('/checkout/shipping', [ShoppingCartController::class, 'chooseShippingMethod'])
                ->middleware('check_login')
                ->name('shipping');

Route::post('/shipping', [ShoppingCartController::class, 'addShippingData']);

//Route::delete('/remove_item/{id}', [ShoppingCartController::class, 'removeFromShoppingCart']);

Route::delete('/remove_item_customer/{item}/{id}', [CartItemController::class, 'destroy'])
                ->name('remove_item_customer');

Route::delete('/remove_item/{id}', [CartItemController::class, 'destroy'])
                ->name('remove_item');

Route::get('/shopping_cart', [ShoppingCartController::class, 'index'])
                ->name('shopping_cart');

//Route::get('/checkout/recap', [ShoppingCartController::class, 'recapitulation'])
 //               ->name('recapitulation');

 Route::get('/checkout/recap', [OrderController::class, 'index'])
                ->middleware('chack_payment_shipment')
                ->name('recapitulation');

Route::put('/quantity/{item}', [CartItemController::class, 'update']);

Route::get('/', function () {

    $new = Product::orderByDesc('updated_at')
                    ->take(12)
                    ->get();

    $categories = Category::all();
    
    $sale = Product::whereHas('categories', function($q) {
        $q->whereIn('name', ["SALE"]);
    });
    $sale = $sale->take(12)->get();
    return view('layout.index', compact('new', $new, 'categories', $categories, 'sale', $sale));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
