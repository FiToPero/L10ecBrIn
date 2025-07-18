<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\ProductRequest;
use App\Actions\CreateProduct;
use App\Actions\UpdateProduct;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('view', Product::class);

        $filters = $request->all('product', 'productTrashed');

        $products = Product::when($filters['product'] ?? null, function($query, $search){$query->where('productName', 'LIKE', "%". $search ."%");})
        ->paginate(10, ['*'], 'productPage');

        $productsTrashed = Product::onlyTrashed()->when($filters['productTrashed'] ?? null, function($query, $search){$query->where('productName', 'LIKE', "%". $search ."%");})
        ->paginate(5, ['*'], 'trashedPage')
        ->appends(['productPage' => $products->currentPage()]);

        $products->appends(['trashedPage' => $productsTrashed->currentPage()]);

        return Inertia::render('Product', compact('products', 'productsTrashed'));
    }

    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);
        try {
            CreateProduct::run($request); 
                
            return redirect()->route('product.index')->with(['message' => 'Product created successfully.', 'color' => 'green']);
        } catch(\Exception $e) {
            return redirect()->route('product.index')->with(['message' => 'Product creation failed.', 'color' => 'red']);
        }
    }

    public function update(ProductRequest $request)
    {
        $this->authorize('update', Product::class);
        try {
            UpdateProduct::run($request); 

            return redirect()->route('product.index')->with(['message' => 'Product updated successfully.', 'color' => 'cyan']);
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
