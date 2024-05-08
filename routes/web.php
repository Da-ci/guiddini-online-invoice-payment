<?php

use Illuminate\Support\Facades\Route;
use App\Services\SubscriptionPaymentService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/payment/initiate', [SubscriptionPaymentService::class, 'initiatePayment'])->name('payment.initiate');
Route::get('/payment/process', [SubscriptionPaymentService::class, 'confirmPayment'])->name('payment.process');
Route::get('/payment/finalize', [SubscriptionPaymentService::class, 'handlePaymentResponse'])->name('payment.finalize');
