<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElectroMarketController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// ─── PUBLIC ───────────────────────────────────────────────
Route::get('/', [ElectroMarketController::class, 'index']);
Route::get('/login', [ElectroMarketController::class, 'login']);
Route::post('/login', [ElectroMarketController::class, 'loginCheck']);
Route::get('/register', [ElectroMarketController::class, 'register']);
Route::post('/register', [ElectroMarketController::class, 'registerSubmit']);
Route::get('/lang/{lang}', [LocalizationController::class, 'setLang']);

// ─── ADMIN + MANAGER ──────────────────────────────────────
// МАҢЫЗДЫ: /products/create роуты {id} wildcard-тан ЖОҒАРЫ тұруы керек,
// әйтпесе Laravel "create" сөзін ID ретінде оқып, ModelNotFoundException қайтарады.
Route::middleware(['auth', 'role:admin|manager'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});

// ─── AUTH REQUIRED ────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [ElectroMarketController::class, 'index']);
    Route::get('/logout', [ElectroMarketController::class, 'logout']);
    Route::get('/profile', [ElectroMarketController::class, 'profile']);

    // /products/create жоғарыда анықталды — {id} ондай жолды баспайды
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);

    // Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::post('/cart/update/{id}', [CartController::class, 'update']);
    Route::post('/cart/remove/{id}', [CartController::class, 'remove']);

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'store']);

});

// ─── ADMIN ONLY ───────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/analytics', [ElectroMarketController::class, 'analytics']);
    Route::get('/admin/orders', [ElectroMarketController::class, 'orders']);
    Route::post('/admin/orders/{id}/status', [ElectroMarketController::class, 'updateOrderStatus']);
});
