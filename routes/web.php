<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SalesController::class, 'index'])->name('sales.index');

Route::get('/repairs', [SalesController::class, 'repairs'])->name('repairs');

Route::post('/repairs', [SalesController::class, 'repairs'])->name('repairs');


Route::get('/sales', [SalesController::class, 'sales'])->name('sales');

Route::post('/sales', [SalesController::class, 'sales'])->name('sales');
