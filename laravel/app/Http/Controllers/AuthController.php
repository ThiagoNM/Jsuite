<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique: users',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'acces_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
}
