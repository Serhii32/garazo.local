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
    
    // public function store(StoreRecordRequest $request)
    // {
    //     $record = new Record();
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
    //         $record->main_photo = $request->main_photo->store('img/common/records/' . $last_insereted_id, ['disk' => 'uploaded_img']);
    //         $record->save();
    //     }
    //     return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно добавлена']);
    // }
    
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

