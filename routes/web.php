<?php

use App\Http\Controllers\Product;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CartController;

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

Route::get('/', [MainController::class, 'viewMain'])->name('main');
Route::get('marketplace', [MainController::class, 'viewMarketplace'])->name('marketplace');
Route::get('/product/{id}', [MainController::class, 'viewProductDetails'])->name('product.show');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('product-upload', [SellerController::class, 'createProducts'])->name('products.upload');
Route::post('product-upload', [SellerController::class, 'storeProducts'])->name('products.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::delete('/cart/{id}/remove', [CartController::class, 'removeFromCart'])->name('cart.remove')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';

