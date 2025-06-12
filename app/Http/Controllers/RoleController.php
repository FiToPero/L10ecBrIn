<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('view', User::class);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        
        return Inertia::render('Admin-Role', compact('roles', 'permissions'));


    }
}
