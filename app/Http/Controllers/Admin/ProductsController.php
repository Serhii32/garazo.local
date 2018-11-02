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
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
	private $attributesNamesArray;
	private $attributesValuesArray;

	public function __construct()
	{
		$attributesNames = ProductsAttributesName::all();
        $attributesNamesOnlyNamesCollection = $attributesNames->map(function ($attributesName) {
		    return $attributesName->only(['name']);
		});
		for($i=0; $i < count($attributesNamesOnlyNamesCollection); $i++) {
			$this->attributesNamesArray[$i] = $attributesNamesOnlyNamesCollection[$i]['name'];
		}
		$attributesValues = ProductsAttributesValue::all();
        $attributesValuesOnlyValuesCollection = $attributesValues->map(function ($attributesValue) {
		    return $attributesValue->only(['value']);
		});
		for($i=0; $i < count($attributesValuesOnlyValuesCollection); $i++) {
			$this->attributesValuesArray[$i] = $attributesValuesOnlyValuesCollection[$i]['value'];
		}
	}

    public function index()
    {
        $this->authorize('manage', \App\Product::class);
        $products = Product::paginate(12);
        $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        $pageTitle = 'Список товаров';
        return view('admin.products.products-index', compact(['products', 'pageTitle', 'most_saled_last']));
    }
    
    public function create()
    {
        $this->authorize('manage', \App\Product::class);
        $categories = ProductsCategory::pluck('title','id')->all();
        $pageTitle = 'Добавить товар';
        return view('admin.products.products-create', compact(['categories', 'pageTitle']), ['attributesNamesArray' => $this->attributesNamesArray, 'attributesValuesArray' => $this->attributesValuesArray]);
    }
    
    public function store(StoreProductRequest $request)
    {
        $this->authorize('manage', \App\Product::class);
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->category_id = $request->category;
        $product->promo_action = $request->promo_action ?: 0;
        $product->best = $request->best ?: 0;
        $product->novelty = $request->novelty ?: 0;
        $product->titleSEO = $request->titleSEO;
        $product->descriptionSEO = $request->descriptionSEO;
        $product->keywordsSEO = $request->keywordsSEO;
        $product->save();
        $last_insereted_id = $product->id;
        if ($request->main_photo != null) {
            $product->main_photo = $request->main_photo->store('img/common/products/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $product->save();
        }
        if ($request->attributes_names != null && $request->attributes_values != null) {
            for($i = 0; $i < count($request->attributes_names); $i++) {
            	$productsAttributesNames = ProductsAttributesName::all();
            	$productsAttributesValues = ProductsAttributesValue::all();
            	$productAttributesNameExist = 0;
            	$productAttributesValueExist = 0;
            	foreach($productsAttributesNames as $productsAttributesName) {
            		if($request->attributes_names[$i] == $productsAttributesName->name) {
            			$productAttributesNameExist = $productsAttributesName->id;
            			break;
            		}
            	}
            	foreach($productsAttributesValues as $productsAttributesValue) {
            		if($request->attributes_values[$i] == $productsAttributesValue->value) {
            			$productAttributesValueExist = $productsAttributesValue->id;
            			break;
            		}
            	}

            	if ($productAttributesNameExist) {
            		$productsAttributesNameNew = ProductsAttributesName::find($productAttributesNameExist);
            	} else {
            		$productsAttributesNameNew = new ProductsAttributesName();
	            	$productsAttributesNameNew->name = $request->attributes_names[$i];
	            	$productsAttributesNameNew->save();
            	}
            	if ($productAttributesValueExist) {
            		$productsAttributesValueNew = ProductsAttributesValue::find($productAttributesValueExist);
            	} else {
            		$productsAttributesValueNew = new ProductsAttributesValue();
	            	$productsAttributesValueNew->value = $request->attributes_values[$i];
	            	$productsAttributesValueNew->save();
            	}

            	if ($productAttributesNameExist && $productAttributesValueExist && $productsAttributesName->values()->where('products_attributes_value_id', '=', $productAttributesValueExist)->whereHas('products',function($query)use($last_insereted_id){$query->where('product_id', '=', $last_insereted_id);})->first()) {
            		continue;
            	}

            	$productsAttributesNameNew->products()->attach($last_insereted_id); 
            	$productsAttributesValueNew->products()->attach($last_insereted_id); 

            	if ($productAttributesNameExist && $productAttributesValueExist && $productsAttributesName->values()->where('products_attributes_value_id', '=', $productAttributesValueExist)->first()) {
            		continue;
            	}

            	$productsAttributesValueNew->names()->attach($productsAttributesNameNew->id);
            }
        }
        return redirect()->route('admin.products.index')->with(['message' => 'Товар успешно добавлен']);
    }
    
    public function edit(int $id)
    {
        $this->authorize('manage', \App\Product::class);
        $categories = ProductsCategory::pluck('title','id')->all();
        $product = Product::findOrFail($id);
        $pageTitle = 'Редактировать ' . $product->title;
        return view('admin.products.products-edit', compact(['product', 'categories', 'pageTitle']), ['attributesNamesArray' => $this->attributesNamesArray, 'attributesValuesArray' => $this->attributesValuesArray]);
    }
    
    public function update(StoreProductRequest $request, int $id)
    {
        $this->authorize('manage', \App\Product::class);
    	$product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->category_id = $request->category;
        $product->promo_action = $request->promo_action ?: 0;
        $product->best = $request->best ?: 0;
        $product->novelty = $request->novelty ?: 0;
        $product->titleSEO = $request->titleSEO;
        $product->descriptionSEO = $request->descriptionSEO;
        $product->keywordsSEO = $request->keywordsSEO;
        $product->save();
        $last_insereted_id = $product->id;
        if ($request->main_photo != null) {
            if($product->main_photo) {
                Storage::disk('uploaded_img')->delete($product->main_photo);
            }
            $product->main_photo = $request->main_photo->store('img/common/products/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $product->save();
        }

        if ($request->attributes_names != null && $request->attributes_values != null) {
            $product->attributesNames()->detach();
            $product->attributesValues()->detach();
            for($i = 0; $i < count($request->attributes_names); $i++) {
            	$productsAttributesNames = ProductsAttributesName::all();
            	$productsAttributesValues = ProductsAttributesValue::all();
            	$productAttributesNameExist = 0;
            	$productAttributesValueExist = 0;
            	foreach($productsAttributesNames as $productsAttributesName) {
            		if($request->attributes_names[$i] == $productsAttributesName->name) {
            			$productAttributesNameExist = $productsAttributesName->id;
            			break;
            		}
            	}
            	foreach($productsAttributesValues as $productsAttributesValue) {
            		if($request->attributes_values[$i] == $productsAttributesValue->value) {
            			$productAttributesValueExist = $productsAttributesValue->id;
            			break;
            		}
            	}

            	if ($productAttributesNameExist) {
            		$productsAttributesNameNew = ProductsAttributesName::find($productAttributesNameExist);
            	} else {
            		$productsAttributesNameNew = new ProductsAttributesName();
	            	$productsAttributesNameNew->name = $request->attributes_names[$i];
	            	$productsAttributesNameNew->save();
            	}
            	if ($productAttributesValueExist) {
            		$productsAttributesValueNew = ProductsAttributesValue::find($productAttributesValueExist);
            	} else {
            		$productsAttributesValueNew = new ProductsAttributesValue();
	            	$productsAttributesValueNew->value = $request->attributes_values[$i];
	            	$productsAttributesValueNew->save();
            	}

            	if ($productAttributesNameExist && $productAttributesValueExist && $productsAttributesName->values()->where('products_attributes_value_id', '=', $productAttributesValueExist)->whereHas('products',function($query)use($last_insereted_id){$query->where('product_id', '=', $last_insereted_id);})->first()) {
            		continue;
            	}

            	$productsAttributesNameNew->products()->attach($last_insereted_id); 
            	$productsAttributesValueNew->products()->attach($last_insereted_id); 

            	if ($productAttributesNameExist && $productAttributesValueExist && $productsAttributesName->values()->where('products_attributes_value_id', '=', $productAttributesValueExist)->first()) {
            		continue;
            	}

            	$productsAttributesValueNew->names()->attach($productsAttributesNameNew->id);
            }
        }

        return redirect()->route('admin.products.index')->with(['message' => 'Товар успешно обновлен']);
    }
    
    public function destroy(int $id)
    {
        $this->authorize('manage', \App\Product::class);
        Storage::disk('uploaded_img')->deleteDirectory('img/common/products/' . $id);
    	$product = Product::findOrFail($id);
    	$product->attributesNames()->detach();
        $product->attributesValues()->detach();
        $product->delete();
        return redirect()->route('admin.products.index')->with(['message' => 'Товар успешно удален']);
    }

    public function productAttributeDestroy(int $productId, int $attributeNameId, int $attributeValueId) 
    {
        $this->authorize('manage', \App\Product::class);
    	$product = Product::findOrFail($productId);
        $idInPivotTable = $product->attributesNames()->get()->where('id', $attributeNameId)->first()->pivot->get()->where('product_id', $productId)->where('products_attributes_name_id', $attributeNameId)->first()->id;
        $product->attributesValues()->detach($attributeValueId);
        if(count($product->attributesNames()->get()->where('id', $attributeNameId)) < 2) {
            $product->attributesNames()->detach($attributeNameId);
        } else {
            DB::table('product_products_attributes_name')->where('id', $idInPivotTable)->delete();
        }
        return redirect()->back()->with(['message' => 'Характеристика успешно удалена']);
    }
}

