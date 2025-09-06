<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
{
    public function view(User $user): bool
    {
        return $user->role->hasPermission('view_permission');
    }

    public function superRoot(User $user): bool
    {
        return $user->role->hasPermission('superRoot_permission');
    }
}
