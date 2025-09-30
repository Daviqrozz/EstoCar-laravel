<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/auth')->group(function(){
    /*att:Adicionar edit/delete*/
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::prefix('/lista')->group(function(){
    Route::get('/carros',[CarroController::class,'index']);
    Route::get('/carros/{carro}',[CarroController::class,'show']);
    Route::get('/clientes',[ClienteController::class,'index']);
    Route::get('/clientes/{cliente}',[ClienteController::class,'show']);
    Route::get('/vendas',[VendaController::class,'index']);
    Route::get('/vendas/venda}',[VendaController::class,'show']);
});

Route::prefix('/editar')->group(function(){
    Route::put('/carro/{carro}',[CarroController::class,'update']);
    Route::put('/cliente/{cliente}',[ClienteController::class,'update']);
    Route::put('/venda/{venda}',[VendaController::class,'update']);
});

Route::prefix('/criar')->group(function(){
    Route::post('/carro',[CarroController::class,'store']);
    Route::post('/cliente',[ClienteController::class,'store']);
    Route::post('/venda',[VendaController::class,'store']);
});

Route::prefix('/deletar')->group(function(){
    Route::delete('/carros/{carro}',[CarroController::class,'destroy']);
    Route::delete('/clientes/{cliente}',[ClienteController::class,'destroy']);
});

