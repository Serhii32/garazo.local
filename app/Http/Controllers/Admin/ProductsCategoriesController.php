<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductsCategory;
use App\Product;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Storage;

class ProductsCategoriesController extends Controller
{
    public function index()
    {
        $parentCategories = ProductsCategory::where('parent_id', '=', 0)->get();
        $allCategories = ProductsCategory::pluck('title','id')->all();
        $pageTitle = 'Категории товаров';
        return view('admin.products-categories.categories-index', compact('parentCategories','allCategories', 'pageTitle'));
    }
    
    public function store(StoreCategoryRequest $request)
    {
        $category = new ProductsCategory;
        $category->title = $request->title;
        $category->parent_id = $request->parent_id ?: 0;
        $category->save();
        $last_insereted_id = $category->id;
        if ($request->photo != null) {
            $category->photo = $request->photo->store('img/common/categories/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $category->save();
        }
        return back()->with('message', 'Новая категория успешно добавлена');
    }
    
    public function edit(int $id)
    {
        $category = ProductsCategory::findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        $allCategories = ProductsCategory::pluck('title','id')->all();
        unset($allCategories[$id]);
        return view('admin.products-categories.categories-edit', compact(['category', 'allCategories', 'products']));
    }
    
    public function update(StoreCategoryRequest $request, int $id)
    {
        $category = ProductsCategory::findOrFail($id);
        $category->title = $request->title;
        $category->parent_id = $request->parent_id ?: 0;
        $category->save();
        $last_insereted_id = $category->id;
        if ($request->photo != null) {
            if($category->photo) {
                Storage::disk('uploaded_img')->delete($category->photo);
            }
            $category->photo = $request->photo->store('img/common/categories/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $category->save();
        }
        return redirect()->route('admin.productsCategories.index')->with(['message' => 'Категория успешно обновлена']);
    }
    
    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/categories/' . $id);
        $products = Products::where('category_id', $id)->get();
        foreach ($products as $product) {
            $product->category_id = null;
            $product->save();
        }
        $childCategories = ProductsCategory::where('parent_id', $id)->get();
        foreach ($childCategories as $childCategory) {
            $childCategory->parent_id = 0;
            $childCategory->save();
        }
        $category = ProductsCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.productsCategories.index')->with(['message' => 'Категория успешно удалена']);
    }
    public function removeProductFromCategory(int $id, string $type)
    {
        $product = ProductsCategory::findOrFail($id);
        $product->category_id = null;
        $product->save();
        return back()->with(['message' => 'Товар успешно удален с категории']);
    }
}
