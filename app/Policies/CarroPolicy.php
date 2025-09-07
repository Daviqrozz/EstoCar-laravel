<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Carro;

class CarroPolicy
{
    /**
     * Ver todos os carros
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('vendedor') || $user->hasRole('cliente');
    }

    /**
     * Ver um carro específico
     */
    public function view(User $user, Carro $carro)
    {
        return $user->hasRole('admin') 
            || $user->hasRole('vendedor') 
            || $user->hasRole('cliente');
    }

    /**
     * Criar carro
     */
    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('vendedor');
    }

    /**
     * Editar carro
     */
    public function update(User $user, Carro $carro)
    {
        return $user->hasRole('admin') || 
               ($user->hasRole('vendedor') && $user->id === $carro->created_by);
    }

    /**
     * Deletar carro
     */
    public function delete(User $user, Carro $carro)
    {
        return $user->hasRole('admin');
    }
}
