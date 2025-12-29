<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\ServicoController;
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

    Route::get('/me', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });

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
        Route::get('/servicos', [ServicoController::class, 'index']);
        Route::get('/servicos/{servico}', [ServicoController::class, 'show']);
        Route::get('/ordens-servico', [OrdemServicoController::class, 'index']);
        Route::get('/ordens-servico/{ordemServico}', [OrdemServicoController::class, 'show']);
    });

    // Rotas de Criação
    Route::prefix('/criar')->group(function () {
        Route::post('/carro', [CarroController::class, 'store']);
        Route::post('/cliente', [ClienteController::class, 'store']);
        Route::post('/venda', [VendaController::class, 'store']);
        Route::post('/usuario', [UserController::class, 'store']);
        Route::post('/servico', [ServicoController::class, 'store']);
        Route::post('/ordem-servico', [OrdemServicoController::class, 'store']);
    });

    // Rotas de Edição
    Route::prefix('/editar')->group(function () {
        Route::put('/carro/{carro}', [CarroController::class, 'update']);
        Route::put('/cliente/{cliente}', [ClienteController::class, 'update']);
        Route::put('/venda/{venda}', [VendaController::class, 'update']);
        Route::put('/usuario/{user}', [UserController::class, 'update']);
        Route::put('/servico/{servico}', [ServicoController::class, 'update']);
        Route::put('/ordem-servico/{ordemServico}', [OrdemServicoController::class, 'update']);
    });

    // Rotas de Deleção
    Route::prefix('/deletar')->group(function () {
        Route::delete('/carro/{carro}', [CarroController::class, 'destroy']);
        Route::delete('/cliente/{cliente}', [ClienteController::class, 'destroy']);
        Route::delete('/venda/{venda}', [VendaController::class, 'destroy']);
        Route::delete('/usuario/{user}', [UserController::class, 'destroy']);
        Route::delete('/servico/{servico}', [ServicoController::class, 'destroy']);
        Route::delete('/ordem-servico/{ordemServico}', [OrdemServicoController::class, 'destroy']);
    });
});
