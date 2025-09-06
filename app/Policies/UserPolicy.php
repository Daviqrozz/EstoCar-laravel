<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function view(User $user, User $model)
    {
        return $user->id === $model->id || $user->hasRole('admin');
    }

    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->hasRole('admin');
    }

    public function delete(User $user, User $model)
    {
        return $user->hasRole('admin');
    }
}
