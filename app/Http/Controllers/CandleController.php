<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candle;

class CandleController extends Controller
{

    public function index()
    {
        // Fetch all candles from the database
        $candles = Candle::all();

        // Return a JSON response
        return response()->json($candles);
    }
    
    public function store(Request $request)
    {
        $requestBody = $request->all();
        \Log::info('Request Body:', $requestBody);
    
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'title' => 'required|string',
            'discount' => 'nullable|numeric',
        ]);
    
        // Create a new candle
        $candle = Candle::create($validatedData);
    
        // Print request body for debugging
        $requestBody = $request->all();
        \Log::info('Request Body:', $requestBody);
    
        // Return a JSON response
        return response()->json([
            'message' => 'Candle created successfully',
            'candle' => $candle,
        ], 201);
    }
    
}
