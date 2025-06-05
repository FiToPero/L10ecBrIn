<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('root', Role::class);  //////  Ver que pasa con permissions //////////
        $users = User::with('role')->get();
        
        return Inertia::render('Admin-User', compact('users'));
    }

    public function create()
    {
        $this->authorize('root', Role::class);   //////  Ver que pasa con permissions //////////
        return Inertia::render('Forms/UserForms/Create');
    }

    public function store(UserRequest $request)
    {
        $this->authorize('root', Role::class);  //////  Ver que pasa con permissions //////////

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
            'profile_photo_path' => '', //$request->file('profile_photo_path') ? $request->file('profile_photo_path')->store('public/profile_photos') : null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
        return redirect()->route('adminUser.index')->with('success', 'User created successfully.');
    }

}
