<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        return response()->json(Servico::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:90',
        ]);

        $servico = Servico::create($data);

        return response()->json($servico, 201);
    }

    public function show(string $id)
    {
        $servico = Servico::findOrFail($id);

        return response()->json($servico);
    }

    public function update(Request $request, string $id)
    {
        $servico = Servico::findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string|max:90',
        ]);

        $servico->update($data);

        return response()->json($servico);
    }

    public function destroy(string $id)
    {
        $servico = Servico::findOrFail($id);
        $servico->delete();

        return response()->json(null, 204);
    }
}
