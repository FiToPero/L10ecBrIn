<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\ProductRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('view', Product::class);

        $filters = $request->all('product', 'productTrashed');

        $products = Product::when($filters['product'] ?? null, function($query, $search){$query->where('productName', 'LIKE', "%". $search ."%");})->paginate(10);
        $productsTrashed = Product::onlyTrashed()->when($filters['productTrashed'] ?? null, function($query, $search){$query->where('productName', 'LIKE', "%". $search ."%");})->paginate(5);


        return Inertia::render('Product', compact('products', 'productsTrashed'));
        // return redirect()->route('product.index')->with('message', 'You are not authorized to access this page');
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
            return redirect()->route('product.index')->with(['message' => 'Product created successfully.', 'color' => 'green']);
       } catch(\Exception $e) {
            return redirect()->route('product.index')->with(['message' => 'Product creation failed.', 'color' => 'red']);
       }
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
                if(is_string($request->image_01)){ $imageUrl_01 = $request->image_01; }
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
            return redirect()->route('product.index')->with(['message' => 'Product updated successfully.', 'color' => 'blue']);
        } catch (\Exception $e){
            return redirect()->route('product.index')->with(['message' => 'Product updated failed.', 'color' => 'red']);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->authorize('delete', Product::class);
            Product::destroy($id);
            return redirect()->route('product.index')->with(['message' => 'Product Deleted succcess.', 'color' => 'red']);
        } catch (\Exception $e) {
            return redirect()->route('product.index')->with(['message' => 'Product Deleted failed.', 'color' => 'red']);
        }
    }

    public function restore(string $id)
    {
       try {
            $this->authorize('restore', Product::class);
            Product::withTrashed()->find($id)->restore();
            return redirect()->route('product.index')->with(['message' => 'Product Restored succcess.', 'color' => 'blue']);
        } catch (\Exception $e) {
            return redirect()->route('product.index')->with(['message' => 'Product Restored failed.', 'color' => 'red']);
        }
    }

    public function forceDestroy(string $id)
    {
        try {
            $this->authorize('forceDelete', Product::class);
            Product::withTrashed()->find($id)->forceDelete();
            return redirect()->route('product.index')->with(['message' => 'Product Deleted permanently succcess.', 'color' => 'red']);
        } catch (\Exception $e) {
            return redirect()->route('product.index')->with(['message' => 'Product Deleted permanently failed.', 'color' => 'red']);
        }
    }

}
