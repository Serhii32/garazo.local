<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RecordsCategory;
use App\Record;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Storage;

class RecordsCategoriesController extends Controller
{
    public function index()
    {
        $parentCategories = RecordsCategory::where('parent_id', '=', 0)->get();
        $allCategories = RecordsCategory::pluck('title','id')->all();
        $pageTitle = 'Категории новостей';
        return view('admin.records-categories.categories-index', compact('parentCategories','allCategories', 'pageTitle'));
    }
    
    public function store(StoreCategoryRequest $request)
    {
        $category = new RecordsCategory;
        $category->title = $request->title;
        $category->short_description = $request->short_description;
        $category->titleSEO = $request->titleSEO;
        $category->descriptionSEO = $request->descriptionSEO;
        $category->keywordsSEO = $request->keywordsSEO;
        $category->parent_id = $request->parent_id ?: 0;
        $category->save();
        $last_insereted_id = $category->id;
        if ($request->photo != null) {
            $category->photo = $request->photo->store('img/common/recordsCategories/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $category->save();
        }
        return back()->with('message', 'Новая категория успешно добавлена');
    }
    
    public function edit(int $id)
    {
        $category = RecordsCategory::findOrFail($id);
        $records = Record::where('category_id', $id)->get();
        $allCategories = RecordsCategory::pluck('title','id')->all();
        unset($allCategories[$id]);
        $pageTitle = 'Редактировать ' . $category->title;
        return view('admin.records-categories.categories-edit', compact(['category', 'allCategories', 'records', 'pageTitle']));
    }
    
    public function update(StoreCategoryRequest $request, int $id)
    {
        $category = RecordsCategory::findOrFail($id);
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
            $category->photo = $request->photo->store('img/common/recordsCategories/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $category->save();
        }
        return redirect()->route('admin.recordsCategories.index')->with(['message' => 'Категория успешно обновлена']);
    }
    
    public function destroy(int $id)
    {
        Storage::disk('uploaded_img')->deleteDirectory('img/common/recordsCategories/' . $id);
        $records = Record::where('category_id', $id)->get();
        foreach ($records as $record) {
            $record->category_id = null;
            $record->save();
        }
        $childCategories = RecordsCategory::where('parent_id', $id)->get();
        foreach ($childCategories as $childCategory) {
            $childCategory->parent_id = 0;
            $childCategory->save();
        }
        $category = RecordsCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.recordsCategories.index')->with(['message' => 'Категория успешно удалена']);
    }
    public function removeRecordFromCategory(int $id, string $type)
    {
        $record = Record::findOrFail($id);
        $record->category_id = null;
        $record->save();
        return back()->with(['message' => 'Новость успешно удалена с категории']);
    }
}
