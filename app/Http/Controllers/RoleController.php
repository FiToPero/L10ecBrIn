<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('view', Role::class);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return Inertia::render('Admin-Role', compact('roles', 'permissions'));
    }

    public function create()
    {
        $this->authorize('create', Role::class);
        $permissions = Permission::all();

        return Inertia::render('Forms/RolesForms/Create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);
        try {
            $role = Role::create([
                'name' => $request->name,
            ]);
            $role->permissions()->sync($request->permissions);            

            return redirect()->route('adminRole.index')->with(['message' => 'Role created successfully.', 'color' => 'green']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Error creating role', 'color' => 'red']);            
        }
    }

    public function update(RoleRequest $request)
    {
        $this->authorize('update', Role::class);
        try {
            $role = Role::findOrFail($request->id);
        
            $role->permissions()->sync(collect($request->permissions)->pluck('id')->toArray());            

            return redirect()->route('adminRole.index')->with(['message' => 'Role updated successfully.', 'color' => 'green']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Error Update role', 'color' => 'red']);            
        }
    }
}
