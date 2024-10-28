<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class RootController extends Controller
{
    public function index()
    {
        $products = Product::onlyTrashed()->get();
        
        return Inertia::render('Admin-Root', compact('products'));
    }
}
