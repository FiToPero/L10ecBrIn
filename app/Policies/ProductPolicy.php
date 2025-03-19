<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->role->hasPermission('view_product');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->role->hasPermission('view_product');
    }

    /**
     * Determine whether the user can create models.
     */ 
    public function create(User $user)
    {
        return $user->role->hasPermission('create_product');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->role->hasPermission('update_product');
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->role->hasPermission('delete_product');
            
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user)
    {
        return $user->role->hasPermission('restore_product');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user)
    {
        return $user->role->hasPermission('forceDelete_product');
           
    }
}
