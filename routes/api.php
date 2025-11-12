<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rota publica
Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

//Rota protegida
Route::middleware('auth:sanctum')->group(function () {
    // Rota de Logout
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Rotas de Leitura 
    Route::prefix('/lista')->group(function () {
        Route::get('/carros', [CarroController::class, 'index']);
        Route::get('/carros/{carro}', [CarroController::class, 'show']);
        Route::get('/clientes', [ClienteController::class, 'index']);
        Route::get('/clientes/{cliente}', [ClienteController::class, 'show']);
        Route::get('/vendas', [VendaController::class, 'index']);
        Route::get('/vendas/{venda}', [VendaController::class, 'show']);
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{user}', [UserController::class, 'show']);
    });

    // Rotas de Criação
    Route::prefix('/criar')->group(function () {
        Route::post('/carro', [CarroController::class, 'store']);
        Route::post('/cliente', [ClienteController::class, 'store']);
        Route::post('/venda', [VendaController::class, 'store']);
        Route::post('/usuario', [UserController::class, 'store']);
    });

    // Rotas de Edição
    Route::prefix('/editar')->group(function () {
        Route::put('/carro/{carro}', [CarroController::class, 'update']);
        Route::put('/cliente/{cliente}', [ClienteController::class, 'update']);
        Route::put('/venda/{venda}', [VendaController::class, 'update']);
        Route::put('/usuario/{user}', [UserController::class, 'update']);

    });

    // Rotas de Deleção
    Route::prefix('/deletar')->group(function () {
        Route::delete('/carro/{carro}', [CarroController::class, 'destroy']);
        Route::delete('/cliente/{cliente}', [ClienteController::class, 'destroy']);
        Route::delete('/venda/{venda}', [VendaController::class, 'destroy']);
        Route::delete('/usuario/{user}', [UserController::class, 'destroy']);
    });
});
