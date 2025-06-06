<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\ProductRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
        $filters = $request->all('search');
        
        $products = Product::when($filters['search'] ?? null, function($query, $search){$query->where('productName', 'LIKE', "%". $search ."%");})->orderBy('priority', 'asc')->paginate(15);

        return Inertia::render('Welcome', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        
        return Inertia::render('Forms/ProductForms/Create');
    }

    public function store(ProductRequest $request)
    {
       try {
            $this->authorize('create', Product::class);
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
            return redirect()->route('product.index')->with('message', 'Product created succcess.');
       } catch(\Exception $e) {
            return redirect()->route('product.index')->with('message', 'Product created failed.');
       }
    }

    public function show(Request $request)
    {
        // try {
        //     $product = Product::findOrFail($request->id);
        //     return Inertia::render('Show', compact('product'));
        // } catch (\Exception $e){

        // }
    }

    public function edit(string $id)
    {
        try {
            $this->authorize('update', Product::class);
            $product = Product::findOrFail($id);
            
            return Inertia::render('Forms/ProductForms/Edit', compact('product'));
        } catch (\Exception $e) {
            
        }
    }

    public function update(ProductRequest $request, string $id)
    {
        try {
            $this->authorize('update', Product::class);
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
            return redirect()->route('dashboard.index')->with('message', 'Product Update succcess.');
        } catch (\Exception $e){
            return redirect()->route('dashboard.index')->with('message', 'Product Update failed.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->authorize('delete', Product::class);
            Product::destroy($id);
            return redirect()->route('dashboard.index')->with('message', 'Product Deleted succcess.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.index')->with('message', 'Product Deleted failed.');
        }
    }

    public function restore(string $id)
    {
       try {
            $this->authorize('restore', Product::class);
            Product::withTrashed()->find($id)->restore();
            return redirect()->route('adminRoot.index')->with('message', 'Product Restored succcess.');
        } catch (\Exception $e) {
            return redirect()->route('adminRoot.index')->with('message', 'Product Restored failed.');
        }
    }

    public function forceDestroy(string $id)
    {
        try {
            $this->authorize('forceDelete', Product::class);
            Product::withTrashed()->find($id)->forceDelete();
            return redirect()->route('adminRoot.index')->with('message', 'Product Deleted permanently succcess.');
        } catch (\Exception $e) {
            return redirect()->route('adminRoot.index')->with('message', 'Product Deleted permanently failed.');
        }
    }

}
