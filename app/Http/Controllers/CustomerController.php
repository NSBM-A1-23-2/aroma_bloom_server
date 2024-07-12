<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $customer = Customer::create([
            'email' => $validatedData['email'],
            'fullName' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
            'user_id' => $user->id,
        ]);
    



        $token = $user->createToken('hash')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token,
        ];

        return response($res, 201);
    }

    public function login(Request $request)
{
    $validatedData = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $validatedData['email'])->first();

    if (!$user || !Hash::check($validatedData['password'], $user->password)) {
        return response(['message' => 'Bad credentials'], 401); 
    }
    $token = $user->createToken('hash')->plainTextToken;

    $res = [
        'user' => $user,
        'token' => $token,
    ];
    return response($res, 200);
}

}
