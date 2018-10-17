<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductsCategory;
use App\ProductsAttributesName;
use App\ProductsAttributesValue;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        $pageTitle = 'Список товаров';
        return view('admin.products.products-index', compact(['products', 'pageTitle', 'most_saled_last']));
    }
    
    public function create()
    {
        $categories = ProductsCategory::pluck('title','id')->all();
        $pageTitle = 'Добавить товар';
        return view('admin.products.products-create', compact(['categories', 'pageTitle']));
    }
    
    public function store(StoreProductRequest $request)
    {

        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $product->description;
        $product->short_description = $product->short_description;
        $product->category_id = $product->category;
        $product->promo_action = $request->promo_action ?: 0;
        $product->best = $request->best ?: 0;
        $product->novelty = $request->novelty ?: 0;
        $product->titleSEO = $product->titleSEO;
        $product->descriptionSEO = $product->descriptionSEO;
        $product->keywordsSEO = $product->keywordsSEO;
        $product->save();
        $last_insereted_id = $product->id;
        if ($request->main_photo != null) {
            $product->main_photo = $request->main_photo->store('img/common/products/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $product->save();
        }

        // if ($request->attributes_names != null) {
            
        //     $productsAttributesNames = ProductsAttributesName::all();

        //     for($i = 0; $i < count($request->attributes_names); $i++) {
            	
        //     	$productAttributesNameExist = 0;

        //     	foreach($productsAttributesNames as $productsAttributesName) {
        //     		if($request->attributes_names[$i] == $productsAttributesName->name) {
        //     			$productAttributesNameExist = $productsAttributesName->id;
        //     			break;
        //     		}
        //     	}

        //     	if ($productAttributesNameExist) {
        //     		$productsAttributesNameNew = ProductsAttributesName::find($productAttributesNameExist);
        //     	} else {
        //     		$productsAttributesNameNew = new ProductsAttributesName();
	       //      	$productsAttributesNameNew->name = $request->attributes_names[$i];
	       //      	$productsAttributesNameNew->save();
        //     	}

        //     	$productsAttributesNameNew->products()->attach($last_insereted_id); 

        //     }
        // }
        return redirect()->route('admin.products.index')->with(['message' => 'Товар успешно добавлен']);
    }
    
    // public function edit(int $id)
    // {
    //     $categories = RecordsCategory::pluck('title','id')->all();
    //     $record = Record::findOrFail($id);
    //     $pageTitle = 'Редактировать ' . $record->title;
    //     return view('admin.records.records-edit', compact(['record', 'categories', 'pageTitle']));
    // }
    
    // public function update(StoreRecordRequest $request, int $id)
    // {
    //     $record = Record::findOrFail($id);
    //     $record->title = $request->title;
    //     $record->description = $request->description;
    //     $record->short_description = $request->short_description;
    //     $record->category_id = $request->category;
    //     $record->titleSEO = $request->titleSEO;
    //     $record->descriptionSEO = $request->descriptionSEO;
    //     $record->keywordsSEO = $request->keywordsSEO;
    //     $record->save();
    //     $last_insereted_id = $record->id;
    //     if ($request->main_photo != null) {
    //         if($record->main_photo) {
    //             Storage::disk('uploaded_img')->delete($record->main_photo);
    //         }
    //         $record->main_photo = $request->main_photo->store('img/common/records/' . $last_insereted_id, ['disk' => 'uploaded_img']);
    //         $record->save();
    //     }
    //     return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно обновлена']);
    // }
    
    // public function destroy(int $id)
    // {
    //     Storage::disk('uploaded_img')->deleteDirectory('img/common/records/' . $id);
    //     $record = Record::findOrFail($id);
    //     $record->delete();
    //     return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно удалена']);
    // }
}

