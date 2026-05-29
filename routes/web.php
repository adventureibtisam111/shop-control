<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return redirect('/sales/create');
});

// SALES ROUTES
Route::get('/sales/create', [SaleController::class, 'create']);
Route::post('/sales', [SaleController::class, 'store']);
Route::get('/dashboard', [SaleController::class, 'dashboard']);
Route::get('/credits', [SaleController::class, 'credits']);
Route::get('/sales/history', [SaleController::class, 'history']);

// PRODUCT ROUTES
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/products/category/{category}', [ProductController::class, 'filterByCategory']);

// CART ROUTES
Route::post('/cart/add', [CartController::class, 'add']);
Route::get('/cart', [CartController::class, 'view']);
Route::delete('/cart/{id}', [CartController::class, 'remove']);
Route::put('/cart/{id}/quantity', [CartController::class, 'updateQuantity']);
Route::delete('/cart/clear', [CartController::class, 'clear']);

// CUSTOMER ROUTES
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/create', [CustomerController::class, 'create']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
