<?php

use Illuminate\Support\Facades\Route;
use App\Models\Candle;
use App\Http\Controllers\CandleController;

Route::get('/', function () {
    return view('welcome');
});
