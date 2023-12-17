<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function show(Category $category, Product $product)
    {
        return view('tenants.store.products.show', [
            'product' => $product,
        ]);
    }
}
