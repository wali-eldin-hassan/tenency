<?php

namespace App\Http\Controllers\Tenants\Dashboard;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Tenants\StoreProductRequest;
use App\Http\Requests\Tenants\UpdateProductRequest;

class ProductsController extends Controller
{
    public function index()
    {
        return view('tenants.dashboard.products.index', [
            'products_count' => Product::count(),
            'products' => Product::latest('id')->paginate(parent::ELEMENTS_PER_PAGE),
        ]);
    }

    public function show(Product $product)
    {
        return view('tenants.dashboard.products.show', [
            'product' => $product,
        ]);
    }

    public function create()
    {
        return view('tenants.dashboard.products.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Product::create([
            'name' => $request->name,
            'tenant_id' => tenant('id'),
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name),
            'color' => $request->color,
            'image_path' => $request->file('image')->store(tenant('slug') . '/images/products', 'public'),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        session()->flash('success', 'Product Created Successfully !');

        return redirect()->route('tenant.products.index');
    }

    public function edit(Product $product)
    {
        return view('tenants.dashboard.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name),
            'color' => $request->color,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($request->has('image')) {
            $this->deleteProductImage($product);

            $product->update([
                'image_path' => $request->file('image')->store(tenant('slug') . '/images/products', 'public'),
            ]);
        }

        session()->flash('success', 'Product Updated Successfully !');

        return redirect()->route('tenant.products.index');
    }

    public function destroy(Product $product)
    {
        $this->deleteProductImage($product);

        $product->delete();

        session()->flash('success', 'Product Deleted Successfully !');

        return redirect()->route('tenant.products.index');
    }

    private function deleteProductImage($product)
    {
        Storage::delete('/public/' . $product->image_path);
    }
}
