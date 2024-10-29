<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function root(User $user)
    {
        return $user->hasRole('root');
    }

    public function admin(User $user)
    {
        return $user->hasRole('admin');
    }

    public function user(User $user)
    {
        return $user->hasRole('user');
    }
}
