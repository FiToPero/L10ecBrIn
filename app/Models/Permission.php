<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRoles($rolesName)
    {
        return $this->roles()->where('name', $rolesName)->exists();
    }
}
