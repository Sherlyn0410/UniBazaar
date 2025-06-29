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

Route::middleware(['auth'])->group(function () {

Route::get('/', [MainController::class, 'viewMain'])->name('main');

//user eh route put here (exclude seller)
 Route::prefix('user')->group(function(){

    Route::get('marketplace', [MainController::class, 'viewMarketplace'])->name('marketplace');
    Route::get('/product/{id}', [MainController::class, 'viewProductDetails'])->name('product.show');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
    Route::delete('/cart/{id}/remove', [CartController::class, 'removeFromCart'])->name('cart.remove')->middleware('auth');
    Route::get('/profile', [ProfileController::class, 'viewProfile'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/{product}/product-edit', [ProfileController::class, 'editProduct'])->name('edit.product');
    Route::put('/{product}/product-edit', [ProfileController::class, 'updateProduct'])->name('update.product');
    Route::get('/search', [MainController::class, 'search'])->name('search');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('stripe.checkout');
    Route::post('/charge', [CheckoutController::class, 'charge'])->name('stripe.charge');
    Route::post('/checkout/pay', [CheckoutController::class, 'processCartPayment'])->name('stripe.checkout.pay');
    Route::get('/checkout', [CartController::class, 'checkoutCart'])->name('cart.checkout');
    Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');


});
//seller route put inside here
Route::prefix('seller')->group(function(){

Route::get('product-upload', [SellerController::class, 'createProducts'])->name('products.upload');
Route::post('product-upload', [SellerController::class, 'storeProducts'])->name('products.store');


 });
});

 //admin route put here
Route::prefix('admin')->group(function (){

    Route::get('/', [AdminController::class, 'viewAdmin'])->name('view.admin');
    Route::get('view-student', [AdminController::class, 'viewStudent'])->name('view.student');
    Route::get('view-product', [AdminController::class, 'viewProduct'])->name('view.product');
    Route::get('view-order', [AdminController::class, 'viewOrder'])->name('view.order');
    Route::get('/pending', [AdminController::class, 'pending'])->name('admin.products.pending');
    Route::post('/{product}/approve', [AdminController::class, 'approve'])->name('admin.products.approve');
    Route::post('/{product}/reject', [AdminController::class, 'reject'])->name('admin.products.reject');




});







// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware(['auth'])->group(function () {

});

Route::middleware(['auth'])->group(function () {
    Route::get('/buy-now/{product}', [BuyNowController::class, 'show'])->name('buy.now');
    Route::post('/buy-now/place-order', [BuyNowController::class, 'placeOrder'])->name('buy.now.place');

    Route::get('/chat', [ChatController::class, 'showChat'])->name('chat');
});

require __DIR__.'/auth.php';
