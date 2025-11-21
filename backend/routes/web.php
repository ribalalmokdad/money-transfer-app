<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\BeneficiaryController;

Route::get('/test', function () {
    return view('welcome');
});
Route::post('/payment-methods', [PaymentMethodController::class, 'store']);
Route::put('/payment-methods/{id}', [PaymentMethodController::class, 'update']);
Route::delete('/payment-methods/{id}', [PaymentMethodController::class, 'destroy']);

Route::post('/beneficiaries', [BeneficiaryController::class, 'store']);
Route::get('/beneficiaries', [BeneficiaryController::class, 'index']);
Route::put('/beneficiaries/{id}', [BeneficiaryController::class, 'update']);
Route::delete('/beneficiaries/{id}', [BeneficiaryController::class, 'destroy']);


