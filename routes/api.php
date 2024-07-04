<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandleController;


Route::get('/candles', [CandleController::class, 'index']);
Route::post('/candles/add', [CandleController::class, 'store']);



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
