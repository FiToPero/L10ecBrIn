<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('view', Permission::class);

        $products = Product::all();
        
        return Inertia::render('Dashboard', compact('products'));
    
        // return redirect()->route('product.index')->with('message', 'You are not authorized to access this page');
    
    }
}
