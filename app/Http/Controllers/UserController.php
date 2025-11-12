<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('cargos')->get();

        return response()->json([
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string',
            'cargo' => 'required|integer|exists:cargos,id'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        // vincula o cargo na tabela pivot
        $user->cargos()->attach($validated['cargo']);

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'user' => $user->load('cargos')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'user' => $user->load('cargos')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|min:3|max:100',
            'email' => 'sometimes|email|max:255|unique:users,email,' . ($user->id ?? 'NULL'),
            'password' => 'sometimes|string',
            'cargo' => 'sometimes|integer|exists:cargos,id',
        ]);

        // Atualiza apenas os campos enviados
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }

        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Atualiza o cargo, se enviado
        if (isset($validated['cargo'])) {
            $user->cargos()->sync([$validated['cargo']]);
        }

        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user->load('cargos'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->cargos()->detach(); // remove o vínculo na pivot
        $user->delete();

        return response()->json([
            'message' => 'Usuário deletado com sucesso!'
        ]);
    }
}
