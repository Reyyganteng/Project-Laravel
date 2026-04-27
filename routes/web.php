<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= ADMIN =================
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/report/seles', [AdminController::class, 'selesReport'])->name('admin.seles');

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/orders/{id}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
});

// ================= PRODUCT =================
Route::resource('/product', ProductController::class)->middleware('auth');

// ================= CUSTOMER =================
Route::middleware(['auth'])->group(function () {

    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/products', [CustomerController::class, 'product'])->name('customer.products');

    // ================= CART =================
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove');

    // ================= ORDER =================
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('customer.checkout');
    Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('customer.checkout.process');
    Route::get('/orders', [OrderController::class, 'order'])->name('customer.orders');
    Route::get('/orders/{orderId}', [OrderController::class, 'orderDetail'])->name('customer.order-detail');
    Route::get('/orders/{orderId}/confirmation', [OrderController::class, 'confirmation'])->name('customer.order.confirmation');
});
