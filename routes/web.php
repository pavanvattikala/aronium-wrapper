<?php

use App\Http\Controllers\AnalyticsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TypesMiddleware;


Route::get('/', [AnalyticsController::class, 'index'])->name('analytics.index');


Route::prefix("analytics")->middleware(TypesMiddleware::class)->group(
    function () {
        Route::any('/by_date', [AnalyticsController::class, 'by_date'])->name('analytics.by_date');

        Route::any('/by-document', [AnalyticsController::class, 'by_document'])->name('analytics.by_document');
    }
);
