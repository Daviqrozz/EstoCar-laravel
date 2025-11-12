<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
  
    $cars = Carro::query()
        // 1. Prioriza 'status = 1' usando ordenação descendente ('desc')
        ->orderBy('status', 'desc')
        // 2. Ordenação secundária para garantir uma ordem estável (usando o ID mais recente)
        ->orderBy('id', 'desc')
        ->get();

    return response()->json([
        'carros' => $cars
    ]);
}

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'cor' => 'required|string',
            'ano' => 'required|integer',
            'preco' => 'required|numeric',
        ]);
        $validated['usuario_id'] = auth('sanctum')->id();
        $carro = Carro::create([
            'marca' => $validated['marca'],
            'modelo' => $validated['modelo'],
            'ano' => $validated['ano'],
            'cor' => $validated['cor'],
            'preco' => $validated['preco'],
            'status' => 1
        ]);

        return response()->json([
                'message' => 'Carro criado com sucesso!',
                'carro' => $carro,
        ]);

    }

    /**
     * Display the specified resource.
     */
   public function show(Carro $carro)
    {
        return response()->json([
            "carro" => $carro
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carro $carro)
    {
        $validated = $request->validate([
            'marca' => 'nullable|string',
            'modelo' => 'nullable|string',
            'cor' => 'nullable|string',
            'ano' => 'nullable|integer',
            'preco' => 'nullable|numeric',
            'status' => 'nullable'
        ]);

        $carro->fill($validated);
        
        if($carro->isDirty()){
       /*att:Nao retornando mudanças*/   
        $changes = $carro->getChanges();   

            $carro->save();

            return response()->json([
                'message' => 'Carro atualizado com sucesso!',
                'carro' => $carro,
                'mudancas' => $changes
            ]);

        } else {
            return response()->json([
                'message' => 'Nenhuma alteração foi detectada',
                'carro' => $carro,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carro $carro)
    {
        
        $carro->delete();

        return response()->json([
            'msg' => 'carro deletado com sucesso'
        ]);
    }
}
