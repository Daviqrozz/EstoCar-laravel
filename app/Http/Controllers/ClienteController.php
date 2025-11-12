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
            'clientes' => $clientes
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

        $validated['usuario_id'] = auth('sanctum')->id();
        
        $cliente = Cliente::create($validated,);

        return response()->json([
            'msg' => 'Cliente registrado com sucesso',
            'cliente' => $cliente
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return response()->json([
            'cliente' => $cliente
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
         //Validação
         $validated = $request->validate([
            'nome' => 'nullable|string',
            'cpf' => 'nullable|string',
            'telefone' => 'nullable|string',
            'email' => 'nullable|string',
            'endereco' => 'nullable|string',
        ]);
        //$cliente sera preenchido com os dados de $validated
        $cliente->fill($validated);
        //Verifica se $cliente houve alteração
        if($cliente->isDirty()){
        //armazena as mudanças no $changes
        
        //--!!Metodo nao armazenando--!!//
        $changes = $cliente->getChanges();   
            //salva o cliente
            $cliente->save();

            return response()->json([
                'message' => 'Cliente atualizado com sucesso!',
                'cliente' => $cliente,
                'mudancas' => $changes
            ]);

        } else {
            return response()->json([
                'msg' => 'Nenhuma alteração foi detectada',
                'cliente' => $cliente,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

         return response()->json([
            'msg' => 'Cliente deletado com sucesso'
        ]);
    }
}
