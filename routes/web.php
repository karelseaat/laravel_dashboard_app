<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\MetricController;

Route::get('/', function () {
    return response()->json(['app' => 'Analytics Dashboard']);
});

Route::apiResource('analytics', AnalyticsController::class);
Route::get('/analytics/stats', [AnalyticsController::class, 'stats']);

Route::apiResource('metrics', MetricController::class);
Route::get('/metrics/category/{category}', [MetricController::class, 'byCategory']);
Route::get('/metrics/summary', [MetricController::class, 'summary']);
