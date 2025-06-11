<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WelcomeController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $filters = $request->all('search');
        
        $products = Product::when($filters['search'] ?? null, function($query, $search){$query->where('productName', 'LIKE', "%". $search ."%");})->orderBy('priority', 'asc')->paginate(15);

        return Inertia::render('Welcome', compact('products'));    
    }
}
