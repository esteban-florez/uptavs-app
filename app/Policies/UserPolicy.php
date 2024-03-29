<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('role', 'Administrador');
    }

    public function create(User $user)
    {
        return $user->can('role', 'Administrador');
    }
    
    public function view(User $user, User $model)
    {
        if ($model->can('role', 'Administrador')) return false;
        
        if ($user->can('role', 'Administrador')) return true;

        if ($user->can('role', 'Instructor')) {
            return $model->can('role', 'Estudiante') || $model->id === $user->id;
        }

        return $user->id === $model->id;
    }
    
    public function update(User $user, User $model)
    {
        return $user->can('role', ['Estudiante', 'Instructor'])
            && $user->id === $model->id;
    }
}
