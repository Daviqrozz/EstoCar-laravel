<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',

        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('register-token',['post:read','post:create'])->plainTextToken;
        

         return response()->json([
             'Usuario' => $user,
             'Token' => $token,
             201
         ]);

    }
    
    public function login(Request $request){

        
    }

    public function logout(){

    }

    
}
