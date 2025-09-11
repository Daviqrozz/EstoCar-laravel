<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/auth')->group(function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::prefix('/lista')->group(function(){
    Route::get('/carros',[CarroController::class,'index']);
    Route::get('/carros/{carro}',[CarroController::class,'show']);
    Route::get('/clientes',[ClienteController::class,'index']);
    Route::get('/clientes/{cliente}',[ClienteController::class,'show']);
});

Route::prefix('/editar')->group(function(){
    Route::put('/carros/{carro}',[CarroController::class,'update']);
    Route::put('/clientes/{cliente}',[ClienteController::class,'update']);
});

Route::prefix('/criar')->group(function(){
    Route::post('/carros',[CarroController::class,'store']);
    Route::post('/clientes',[ClienteController::class,'store']);
    
});

Route::prefix('/deletar')->group(function(){
    Route::delete('/carros/{carro}',[CarroController::class,'destroy']);
    Route::delete('/clientes/{cliente}',[ClienteController::class,'destroy']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
