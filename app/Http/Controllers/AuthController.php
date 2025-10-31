<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('register-token',['post:read','post:create'])->plainTextToken;
        

         return response()->json([
             'user' => $user,
             'token' => $token,
         ],201);

    }
    
    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(FacadesAuth::attempt($validated)){
            $user = User::where('email',$validated['email'])->FirstOrFail();

            $token = $user->createToken('login-token',['post:read','post:create'])->plainTextToken;

            return response()->json([
             'msg' => "Usuario Logado",
             'Email' => $validated['email'],
             'token' => $token,
            ],200);
        }
        
        return response()->json([
            'msg' => 'Credenciais invalidas'],
            401
        );
    }

    public function logout(Request $request){
        $token = $request->bearerToken();
    
        if(!$token){
            return response()->json(['Token nao informado'],401);
        }


        $acess_token = PersonalAccessToken::findToken($token);

        if(!$acess_token){
            return response()->json(['Token invalido'],401);
        }

        $acess_token->delete();

        return response()->json(['Logout realizado!']);

}
}