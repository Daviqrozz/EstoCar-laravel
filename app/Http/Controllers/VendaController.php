<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController
{
   
    public function index()
    {
        $vendas = Venda::with(['cliente', 'carro', 'user'])->get();

        return response()->json([
            "vendas" => $vendas
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
        'usuario_id'  => auth('sanctum')->id(),
        'carro_id'    => $validated['carro_id'],
        'valor_venda' => $validated['valor_venda'],
        'status'      => 1,
        'data_venda'  => now(),
        ]);

        $venda->load(['cliente', 'carro','user']);

        $carro->update(['status' => 0]);
        return response()->json([
            'message' => 'Venda realizada com sucesso',
            'venda' => $venda
        ],201);
    
    }

    public function show(Venda $venda)
    {

        $venda->load(['cliente', 'carro', 'user']);
        
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
            if($venda->isDirty('status') && $venda->status == 2){
                $venda->carro->update(['status' => 1]);
            }

            $changes = $venda->getChanges();

            $venda->save();

            return response()->json([
                'message' => 'Venda atualizada com sucesso',
                'venda' => $venda,
                'mudancas' => $changes
            ]);
        }

        return response()->json([
            'message' => 'Nenhuma alteração detectada'
        ]);
    }

 
    public function destroy(Venda $venda)
    {
        $carro = $venda->carro;
        
        $venda->delete();

        $carro->update(['status' => 1]);

        return response()->json([
            'message' => 'Venda deletada com sucesso'
        ]);
    }
}
