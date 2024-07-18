<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MobileConfigController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'getCustomers']);
    Route::get('/detail', [CustomerController::class, 'getCustomersDetail']);
    Route::put('/accept', [CustomerController::class, 'accept']);
    Route::put('/reject', [CustomerController::class, 'reject']);
});

Route::prefix('mobileconfig')->group(function () {
    Route::get('/total-hadiah', [MobileConfigController::class, 'totalHadiah']);
});


