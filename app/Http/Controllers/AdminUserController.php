<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminUserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('root', Role::class);
        $users = User::with('role')->get();
        
        return Inertia::render('Admin-User', compact('users'));
    
        return redirect()->route('dashboard.index')->with('message', 'You are not authorized to access this page');
    
    }

}
