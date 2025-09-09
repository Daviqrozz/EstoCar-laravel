<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Carro::all();

        return response()->json([
            'Carros' => $cars
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
   public function show(Carro $carro)
    {
        return response()->json([
            "Carro" => $carro
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
        $changes = $carro->getChanges();   

            $carro->save();

            return response()->json([
                'message' => 'Carro atualizado com sucesso!',
                'Carro' => $carro,
                'Mudanças' => $changes
            ]);

        } else {
            return response()->json([
                'msg' => 'Nenhuma alteração foi detectada',
                'Carro' => $carro,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
