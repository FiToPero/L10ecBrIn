<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\ProductRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;  /////// $this->authorize()
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use AuthorizesRequests;

    // example of middleware Policy in controller with can method
    // public function __construct()
    // {
    //     $this->middleware('can:update,product')->only(['edit', 'update']);
    //     $this->middleware('can:delete,product')->only('destroy');
    // }

    public function index(Request $request)
    {
        //$user = User::with('role.permissions')->findOrFail(1);
        $filters = $request->all('search');
        
        $products = Product::when($filters['search'] ?? null, function($query, $search){$query->where('productName', 'LIKE', "%". $search ."%");})->paginate(10);

        return Inertia::render('Welcome', compact('products'));  // user
    }

    public function create()
    {
         // example of middleware Policy in controller with authorize method
        $this->authorize('create', Product::class);
        
        return Inertia::render('Create');
    }

    public function store(ProductRequest $request)
    {
        // save image in storage
        if ($request->hasFile('image_01')) {
            $imageUrl_01 = $request->image_01->store('public/images');
            $imageUrl_01 = str_replace('public', 'storage', $imageUrl_01);
        }

        Product::create([
            'productName' => $request->productName,
            'shortDescription' => $request->shortDescription,
            'company' => $request->company,
            'brand' => $request->brand,
            'price' => $request->price,
            'stock' => $request->stock,
            'address' => $request->address,
            'website' => $request->website,
            'email' => $request->email,
            'priority' => $request->priority,
            'remember' => $request->remember,
            'image_01' => $imageUrl_01,
            'image_02' => null,
            'image_03' => null,
            'image_04' => null,
            'image_05' => null
        ]);
        return redirect()->route('product.index')->with('message', 'Producto creado con éxito.');
    }

    public function show(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return Inertia::render('Show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        // Autorizar la acción de actualización
        // $this->authorize('update', $product);
        return Inertia::render('Edit', compact('product'));
    }

    public function update(ProductRequest $request, string $id)
    {
        // save image in storage
        if ($request->hasFile('image_01')) {
            $imageUrl_01 = $request->image_01->store('public/images');
            $imageUrl_01 = str_replace('public', 'storage', $imageUrl_01);
        } else {
            if(is_string($request->image_01)){
                $imageUrl_01 = $request->image_01;
            }
        }
         
        Product::where('id', $id)->update([
            'productName' => $request->productName,
            'shortDescription' => $request->shortDescription,
            'company' => $request->company,
            'brand' => $request->brand,
            'price' => $request->price,
            'stock' => $request->stock,
            'address' => $request->address,
            'website' => $request->website,
            'email' => $request->email,
            'priority' => $request->priority,
            'remember' => $request->remember,
            'image_01' => $imageUrl_01,
            'image_02' => null,
            'image_03' => null,
            'image_04' => null,
            'image_05' => null
        ]);
        return redirect()->route('product.index')->with('message', 'Producto actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        Product::destroy($id);
        // $flight->trashed()
        // $flight->restore();
        return redirect()->route('product.index')->with('message', 'Producto Eliminado con éxito.');
    }

    public function restore(string $id)
    {
        echo "restore";
        // flight->restore();
    }

    public function forceDestroy(string $id)
    {
        echo "forceDestroy";
        // flight->forceDelete();
    }

}
