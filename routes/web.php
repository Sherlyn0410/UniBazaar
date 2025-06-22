<?php

use App\Http\Controllers\Product;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BuyNowController;
use App\Http\Controllers\ChatController;

use Illuminate\Support\Facades\Route;

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

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

Route::get('/', [MainController::class, 'viewMain'])->name('main');
Route::get('marketplace', [MainController::class, 'viewMarketplace'])->name('marketplace');
Route::get('/product/{id}', [MainController::class, 'viewProductDetails'])->name('product.show');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('product-upload', [SellerController::class, 'createProducts'])->name('products.upload');
Route::post('product-upload', [SellerController::class, 'storeProducts'])->name('products.store');

Route::get('view-student', [AdminController::class, 'viewStudent'])->name('view.student');
Route::get('view-product', [AdminController::class, 'viewProduct'])->name('view.product');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::delete('/cart/{id}/remove', [CartController::class, 'removeFromCart'])->name('cart.remove')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/buy-now/{product}', [BuyNowController::class, 'show'])->name('buy.now');
    Route::post('/buy-now/place-order', [BuyNowController::class, 'placeOrder'])->name('buy.now.place');

    Route::get('/chat', [ChatController::class, 'showChat'])->name('chat');
});

require __DIR__.'/auth.php';
