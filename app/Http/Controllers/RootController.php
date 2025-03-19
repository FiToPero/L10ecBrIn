<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RootController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('root', Role::class);
        $products = Product::onlyTrashed()->get();
        
        return Inertia::render('Admin-Root', compact('products'));

        return redirect()->route('dashboard.index')->with('message', 'You are not authorized to access this page');

    }
}
