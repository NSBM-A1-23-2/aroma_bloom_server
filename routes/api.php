<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandleController;
use App\Http\Controllers\CustomerController;


// This retrieve candle
Route::get('/candles', [CandleController::class, 'index']);
Route::post('/candles/add', [CandleController::class, 'store'])->middleware('auth:sanctum');


Route::get('/reviews', [CandleController::class, 'index']);
Route::post('/reviews/add', [CandleController::class, 'index'])->middleware('auth:sanctum');



// Add to cart
Route::post('/cart/add', [CandleController::class, 'store'])->middleware('auth:sanctum');
Route::put('/cart/edit', [CandleController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/cart/delete', [CandleController::class, 'store'])->middleware('auth:sanctum');
Route::get('/cart', [CandleController::class, 'store'])->middleware('auth:sanctum');




// make purchase
Route::post('/purchase', [CandleController::class, 'store'])->middleware('auth:sanctum');




// login as customer
Route::post('/auth/login', [CustomerController::class, 'login']);
Route::post('/auth/register', [CustomerController::class, 'register']);

Route::post('/contact', [CandleController::class, 'store'])->middleware('auth:sanctum');



