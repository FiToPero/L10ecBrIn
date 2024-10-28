<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permissionName)
    {
        return $this->permissions()->where('name', $permissionName)->exists();
    }
}
