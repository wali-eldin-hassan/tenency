<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index()
    {
        return view('tenants.store.products.index', [
            'products' => Product::where('stock', '>', 1)->orderBy('id')->paginate(12),
        ]);
    }

    public function show(Category $category)
    {
        return view('tenants.store.products.index', [
            'category' => $category,
            'products' => $category->products()->where('stock', '>', 1)->orderBy('id')->paginate(12),
        ]);
    }
}
