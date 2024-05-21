<?php

use App\Http\Controllers\AnalyticsController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AnalyticsController::class, 'index'])->name('sales.index');

Route::any('/repairs', [AnalyticsController::class, 'repairs'])->name('repairs');

Route::any('/sales', [AnalyticsController::class, 'sales'])->name('sales');

Route::any('/repairs/documents', [AnalyticsController::class, 'repairDocuments'])->name('repairs.documents');

Route::any('/sales/documents', [AnalyticsController::class, 'saleDocuments'])->name('sales.documents');
