<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController
{
   
    public function index()
    {
        $vendas = Venda::all();

        return response()->json([
            "Vendas" => $vendas
        ]);
    }

 
    public function store(Request $request)
    {
        $validated = $request->validate([
            //Usuario ira buscar pelo nome, sistema vai ler pelo ID
            'cliente_id' => 'required|exists:clientes,id',
            'carro_id' => 'required|exists:carros,id',
            'valor_venda' => 'required|numeric',
        ]);

        $carro = Carro::findOrFail($validated['carro_id']);
        if($carro->status == 0 ){
            return response()->json([
                'message' => 'Este carro ja foi vendido'
            ],400);
        }

        $venda = Venda::create([
        'cliente_id'  => $validated['cliente_id'],
        //'usuario_id'  => auth('sanctum')->id(), // automático pelo usuário logado
        /*Debug*/ 'usuario_id' => 1,
        'carro_id'    => $validated['carro_id'],
        'valor_venda' => $validated['valor_venda'],
        'status'      => 0,
        'data_venda'  => now(),
        ]);
        
        $carro->update(['status' => 0]);
        return response()->json([
            'message' => 'Venda realizada com sucesso',
            'venda' => $venda
        ],201);
    
    }

    public function show(Venda $venda)
    {
        return response()->json([
            'venda' => $venda
        ]);
    }

  
    public function update(Request $request, Venda $venda)
    {
        $validated = $request->validate([
            'valor_venda' => 'nullable|numeric',
            'status' => 'nullable|integer|in:0,1,2'
        ]);

        $venda->fill($validated);

        if($venda->isDirty()){
            /*att:nao armazenando mudanças*/
            $changes = $venda->getChanges();

            $venda->save();

            return response()->json([
                'message' => 'Venda atualizada com sucesso',
                'venda' => $venda,
                'mudanças' => $changes
            ]);
        }

        return response()->json([
            'message' => 'Nenhuma alteração detectada'
        ]);
    }

 
    public function destroy(Venda $venda)
    {
        $venda->delete();
        return response()->json([
            'message' => 'Venda deletada com sucesso'
        ]);
    }
}
