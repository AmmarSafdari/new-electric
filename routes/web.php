<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Route;

// Storefront
Route::get('/', [StorefrontController::class, 'home'])->name('home');
Route::get('/search', [StorefrontController::class, 'search'])->name('search');
Route::get('/about', [StorefrontController::class, 'about'])->name('about');
Route::get('/contact', [StorefrontController::class, 'contact'])->name('contact');
Route::get('/shipping-policy', [StorefrontController::class, 'shipping'])->name('shipping');
Route::get('/returns-policy', [StorefrontController::class, 'returns'])->name('returns');
Route::get('/privacy-policy', [StorefrontController::class, 'privacy'])->name('privacy');
Route::get('/category/{slug}', [StorefrontController::class, 'category'])->name('category');
Route::get('/product/{slug}', [StorefrontController::class, 'product'])->name('product');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout + Orders
Route::middleware('throttle:10,1')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('throttle:5,1');
});

Route::get('/order/success', function () {
    $orderId = session('last_order_id');
    if (!$orderId) return redirect()->route('home');
    $order = \App\Models\Order::with('items')->findOrFail($orderId);
    return view('storefront.order-success', compact('order'));
})->name('order.success');

// Sitemap
Route::get('/sitemap.xml', function () {
    $products   = \App\Models\Product::select('slug', 'updated_at')->get();
    $categories = \App\Models\Category::select('slug', 'updated_at')->get();
    return response()->view('sitemap', compact('products', 'categories'))
        ->header('Content-Type', 'application/xml');
})->name('sitemap');
