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
        $this->authorize('manage', \App\ProductsCategory::class);
        $parentCategories = ProductsCategory::where('parent_id', '=', 0)->get();
        $allCategories = ProductsCategory::pluck('title','id')->all();
        $pageTitle = 'Категории товаров';
        return view('admin.products-categories.categories-index', compact('parentCategories','allCategories', 'pageTitle'));
    }
    
    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('manage', \App\ProductsCategory::class);
        $category = new ProductsCategory;
        $category->title = $request->title;
        $category->short_description = $request->short_description;
        $category->titleSEO = $request->titleSEO;
        $category->descriptionSEO = $request->descriptionSEO;
        $category->keywordsSEO = $request->keywordsSEO;
        $category->parent_id = $request->parent_id ?: 0;
        $category->save();
        $last_insereted_id = $category->id;
        if ($request->photo != null) {
            $category->photo = $request->photo->store('img/common/productsCategories/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $category->save();
        }
        return back()->with('message', 'Новая категория успешно добавлена');
    }
    
    public function edit(int $id)
    {
        $this->authorize('manage', \App\ProductsCategory::class);
        $category = ProductsCategory::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(12);
        $allCategories = ProductsCategory::pluck('title','id')->all();
        unset($allCategories[$id]);
        $pageTitle = 'Редактировать ' . $category->title;
        return view('admin.products-categories.categories-edit', compact(['category', 'allCategories', 'products', 'pageTitle']));
    }
    
    public function update(StoreCategoryRequest $request, int $id)
    {
        $this->authorize('manage', \App\ProductsCategory::class);
        $category = ProductsCategory::findOrFail($id);
        $category->title = $request->title;
        $category->parent_id = $request->parent_id ?: 0;
        $category->short_description = $request->short_description;
        $category->titleSEO = $request->titleSEO;
        $category->descriptionSEO = $request->descriptionSEO;
        $category->keywordsSEO = $request->keywordsSEO;
        $category->save();
        $last_insereted_id = $category->id;
        if ($request->photo != null) {
            if($category->photo) {
                Storage::disk('uploaded_img')->delete($category->photo);
            }
            $category->photo = $request->photo->store('img/common/productsCategories/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $category->save();
        }
        return redirect()->route('admin.productsCategories.index')->with(['message' => 'Категория успешно обновлена']);
    }
    
    public function destroy(int $id)
    {
        $this->authorize('manage', \App\ProductsCategory::class);
        Storage::disk('uploaded_img')->deleteDirectory('img/common/productsCategories/' . $id);
        $products = Product::where('category_id', $id)->get();
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
        $this->authorize('manage', \App\ProductsCategory::class);
        $product = Product::findOrFail($id);
        $product->category_id = null;
        $product->save();
        return back()->with(['message' => 'Товар успешно удален с категории']);
    }
}
