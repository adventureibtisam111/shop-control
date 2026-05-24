<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return redirect('/sales/create');
});

Route::get('/sales/create', [SaleController::class, 'create']);
Route::post('/sales', [SaleController::class, 'store']);

Route::get('/dashboard', [SaleController::class, 'dashboard']);

Route::get('/credits', [SaleController::class, 'credits']);
Route::get('/sales/history', [SaleController::class, 'history']);