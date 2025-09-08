<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/auth')->group(function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::prefix('/lista')->group(function(){
    Route::get('/carros',[CarroController::class,'index']);
    Route::get('/carros/{id}',[CarroController::class,'show']);
});

Route::prefix('/carros')->group(function(){
    Route::get('/criar',[CarroController::class,'store']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
