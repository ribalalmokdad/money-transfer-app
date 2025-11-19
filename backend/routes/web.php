<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentMethodController;

Route::get('/test', function () {
    return view('welcome');
});
Route::post('/payment-methods', [PaymentMethodController::class, 'store']);
Route::put('/payment-methods/{id}', [PaymentMethodController::class, 'update']);
Route::delete('/payment-methods/{id}', [PaymentMethodController::class, 'destroy']);


