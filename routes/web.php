<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ArtisanController;

// ===== Public Routes =====
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ===== Auth Routes =====
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== Customer Routes =====
Route::prefix('customer')->as('customer.')->middleware(['auth'])->group(function () {
    Route::get('/home', [CustomerController::class, 'home'])->name('home');
    Route::get('/shop', [CustomerController::class, 'shop'])->name('shop');
    Route::get('/product/{id}', [CustomerController::class, 'product'])->name('product');
    Route::get('/cart', [CustomerController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [CustomerController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('cart.remove');
    Route::put('/cart/update', [CustomerController::class, 'updateCart'])->name('cart.update');
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CustomerController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}', [CustomerController::class, 'orderDetails'])->name('order.details');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');
});

// ===== Artisan Routes =====
Route::prefix('artisan')->as('artisan.')->middleware(['auth'])->group(function () {
    Route::get('/home', [ArtisanController::class, 'home'])->name('home');
    Route::get('/products', [ArtisanController::class, 'products'])->name('products');
    Route::get('/add-product', [ArtisanController::class, 'addProduct'])->name('add-product');
    Route::post('/add-product', [ArtisanController::class, 'storeProduct'])->name('store-product');
    Route::get('/edit-product/{id}', [ArtisanController::class, 'editProduct'])->name('edit-product');
    Route::put('/edit-product/{id}', [ArtisanController::class, 'updateProduct'])->name('update-product');
    Route::delete('/product/{id}', [ArtisanController::class, 'deleteProduct'])->name('delete-product');
    Route::patch('/product/{id}/toggle', [ArtisanController::class, 'toggleProduct'])->name('toggle-product');
    Route::get('/orders', [ArtisanController::class, 'orders'])->name('orders');
    Route::patch('/orders/{id}/status', [ArtisanController::class, 'updateOrderStatus'])->name('update-order');
    Route::get('/analytics', [ArtisanController::class, 'analytics'])->name('analytics');
    Route::get('/edit-profile', [ArtisanController::class, 'editProfile'])->name('edit-profile');
    Route::put('/edit-profile', [ArtisanController::class, 'updateProfile'])->name('update-profile');
    Route::get('/shop-preview', [ArtisanController::class, 'shopPreview'])->name('shop-preview');
});