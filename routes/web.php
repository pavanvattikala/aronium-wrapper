<?php

use App\Http\Controllers\AnalyticsController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AnalyticsController::class, 'index'])->name('analytics.index');

Route::any('/analytics', [AnalyticsController::class, 'by_date'])->name('analytics.by_date');
