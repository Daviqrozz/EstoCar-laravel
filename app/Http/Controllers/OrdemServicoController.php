<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\OrdemServicoRegistro;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $ordens = OrdemServico::with(['cliente', 'carro', 'user', 'registros.servico'])->get();

        return response()->json([
            'ordens_servico' => $ordens,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'carro_id'   => 'required|exists:carros,id',
            'status' => 'nullable|integer',
            'descricao'  => 'required|string|max:300',
            'servico_id' => 'required|exists:servicos,id',
            'valor_total' => 'nullable|numeric'
        ]);

        $carro = Carro::findOrFail($validated['carro_id']);
        
        $cliente = Cliente::findOrFail($validated['cliente_id']);

        $ordem = OrdemServico::create([
            'cliente_id'    => $validated['cliente_id'],
            'carro_id'      => $validated['carro_id'],
            'usuario_id'    => auth('sanctum')->id(),
            'descricao'     => $validated['descricao'],
            'status'        => $validated['status'],
            'data_abertura' => now(),
            'valor_total'   => $validated['valor_total'] ?? 0,
        ]);

        OrdemServicoRegistro::create([
            'ordem_servico_id' => $ordem->id,
            'servico_id'       => $validated['servico_id'],
        ]);

        $ordem->load(['cliente', 'carro', 'user', 'registros.servico']);

        return response()->json([
            'message' => 'Ordem de serviço criada com sucesso',
            'ordem_servico' => $ordem,
        ], 201);
    }

    public function show(OrdemServico $ordemServico)
    {
        $ordemServico->load(['cliente', 'carro', 'user', 'registros.servico']);

        return response()->json([
            'ordem_servico' => $ordemServico,
        ]);
    }

    public function update(Request $request, OrdemServico $ordemServico)
    {
        $validated = $request->validate([
            'status'      => 'nullable|integer|in:0,1,2,3',
            'valor_total' => 'nullable|numeric',
        ]);

        $ordemServico->fill($validated);

        if ($ordemServico->isDirty()) {
            $changes = $ordemServico->getChanges();
            $ordemServico->save();

            return response()->json([
                'message'  => 'Ordem de serviço atualizada com sucesso',
                'ordem'    => $ordemServico,
                'mudancas' => $changes,
            ]);
        }

        return response()->json([
            'message' => 'Nenhuma alteração detectada',
        ]);
    }

    public function destroy(OrdemServico $ordemServico)
    {
        $ordemServico->delete();

        return response()->json([
            'message' => 'Ordem de serviço deletada com sucesso',
        ]);
    }
}
