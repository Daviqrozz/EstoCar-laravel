<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();

        return response()->json([
            'Clientes' => $clientes
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string',
            'cpf' => 'required|unique:clientes,cpf',
            'telefone' => 'required|string',
            'email' => 'required|string|email',
            'endereco' => 'required|string'
        ]);

        $cliente = Cliente::create($validated);

        return response()->json([
            'msg' => 'Cliente registrado com sucesso',
            'Cliente' => $cliente
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return response()->json([
            'Cliente' => $cliente
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
