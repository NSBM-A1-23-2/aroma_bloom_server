<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;





// This retrieve candle
Route::get('/candles', [CandleController::class, 'index']);
Route::post('/candles/add', [CandleController::class, 'store'])->middleware('auth:sanctum');


Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews/add', [ReviewController::class, 'add'])->middleware('auth:sanctum');



// Add to cart
Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth:sanctum');
Route::put('/cart/edit', [CartController::class, 'edit'])->middleware('auth:sanctum');
Route::delete('/cart/delete', [CartController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth:sanctum');


// make purchase
Route::post('/order/place', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('/purchase/view', [OrderController::class, 'view'])->middleware('auth:sanctum');
Route::get('/purchase/cancel', [OrderController::class, 'cancel'])->middleware('auth:sanctum');






// login as customer
Route::post('/auth/login', [CustomerController::class, 'login']);
Route::post('/auth/register', [CustomerController::class, 'register']);

Route::post('/contact', [ContactController::class, 'store']);



