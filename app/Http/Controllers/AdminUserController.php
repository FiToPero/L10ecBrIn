<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('view', User::class); 
        $users = User::all();
        $roles = Role::all();
        
        return Inertia::render('Admin-User', compact('users', 'roles'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::all();
        return Inertia::render('Forms/UserForms/Create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        try {
            $this->authorize('create', User::class);

                // save image in storage
                if ($request->hasFile('profile_photo_path')) {
                    $imageUrl_01 = $request->profile_photo_path->store('public/users/images');
                    $imageUrl_01 = str_replace('public', 'storage', $imageUrl_01);
                }

            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip_code' => $request->zip_code,
                'company' => $request->company,
                'profile_photo_path' => $imageUrl_01,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);
            return redirect()->route('adminUser.index')->with('message', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('adminUser.index')->with('message', 'User created fail.');
        }
    }

    public function edit($id)
    {
        try {
            $this->authorize('update', User::class);
            $user = User::findOrFail($id);
            $roles = Role::all();

            return Inertia::render('Forms/UserForms/Edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(UserRequest $request, String $id)
    { 
        try {
            $this->authorize('update', User::class);

            ///// save image in storage
            if ($request->hasFile('profile_photo_path')) {
                $imageUrl_01 = $request->profile_photo_path->store('public/users/images');
                $imageUrl_01 = str_replace('public', 'storage', $imageUrl_01);
            } else {
                if(is_string($request->profile_photo_path)){
                    $imageUrl_01 = $request->profile_photo_path;
                }
            }

            User::where('id', $id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip_code' => $request->zip_code,
                'company' => $request->company,
                'email' => $request->email,
                'profile_photo_path' => $imageUrl_01,
                'role_id' => $request->role_id,
            ]);
            return redirect()->route('adminUser.index')->with('message', 'User updated successfully.');
        }catch (\Exception $e) {
            return redirect()->route('adminUser.index')->with('message', 'User updated fail.');
        }
    }

        public function destroy(string $id)
    {
        try {
            $this->authorize('delete', User::class);
            User::destroy($id);
            return redirect()->route('adminUser.index')->with('message', 'User Deleted succcess.');
        } catch (\Exception $e) {
            return redirect()->route('adminUser.index')->with('message', 'User Deleted failed.');
        }
    }

    public function restore(string $id)
    {
       try {
            $this->authorize('restore', User::class);
            User::withTrashed()->find($id)->restore();
            return redirect()->route('adminRoot.index')->with('message', 'User Restored succcess.');
        } catch (\Exception $e) {
            return redirect()->route('adminRoot.index')->with('message', 'User Restored failed.');
        }
    }

    public function forceDestroy(string $id)
    {
        try {
            $this->authorize('forceDelete', User::class);
            User::withTrashed()->find($id)->forceDelete();
            return redirect()->route('adminRoot.index')->with('message', 'User Deleted permanently succcess.');
        } catch (\Exception $e) {
            return redirect()->route('adminRoot.index')->with('message', 'User Deleted permanently failed.');
        }
    }
}
