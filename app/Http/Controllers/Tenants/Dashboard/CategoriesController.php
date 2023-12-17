<?php

namespace App\Http\Controllers\Tenants\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Tenants\StoreCategoryRequest;
use App\Http\Requests\Tenants\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('tenants.dashboard.categories.index', [
            'categories_count' => Category::count(),
            'categories' => Category::latest('id')->paginate(parent::ELEMENTS_PER_PAGE),
        ]);
    }

    public function create()
    {
        return view('tenants.dashboard.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'image_path' => $request->file('image')->store(tenant('slug') . '/images/categories', 'public'),
            'tenant_id' => tenant('id'),
        ]);

        session()->flash('success', 'Category Created Successfully !');

        return redirect()->route('tenant.categories.index');
    }

    public function edit(Category $category)
    {
        return view('tenants.dashboard.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
        ]);

        if ($request->has('image')) {
            $this->deleteCategoryImage($category);

            $category->update([
                'image_path' => $request->file('image')->store(tenant('slug') . '/images/categories', 'public'),
            ]);
        }

        session()->flash('success', 'Category Updated Successfully !');

        return redirect()->route('tenant.categories.index');
    }

    public function destroy(Category $category)
    {
        $this->deleteCategoryImage($category);

        $category->delete();

        session()->flash('success', 'Category Deleted Successfully !');

        return redirect()->route('tenant.categories.index');
    }

    private function deleteCategoryImage($category)
    {
        Storage::delete('/public/' . $category->image_path);
    }
}
