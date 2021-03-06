<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Record;
use App\RecordsCategory;
use App\Http\Requests\StoreRecordRequest;
use Illuminate\Support\Facades\Storage;

class RecordsController extends Controller
{
    public function index()
    {
        $this->authorize('manage', \App\Record::class);
        $records = Record::paginate(12);
        $pageTitle = 'Список новостей';
        return view('admin.records.records-index', compact(['records', 'pageTitle']));
    }
    
    public function create()
    {
        $this->authorize('manage', \App\Record::class);
        $categories = RecordsCategory::pluck('title','id')->all();
        $pageTitle = 'Добавить новость';
        return view('admin.records.records-create', compact(['categories', 'pageTitle']));
    }
    
    public function store(StoreRecordRequest $request)
    {
        $this->authorize('manage', \App\Record::class);
        $record = new Record();
        $record->title = $request->title;
        $record->description = $request->description;
        $record->short_description = $request->short_description;
        $record->category_id = $request->category;
        $record->titleSEO = $request->titleSEO;
        $record->descriptionSEO = $request->descriptionSEO;
        $record->keywordsSEO = $request->keywordsSEO;
        $record->save();
        $last_insereted_id = $record->id;
        if ($request->main_photo != null) {
            $record->main_photo = $request->main_photo->store('img/common/records/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $record->save();
        }
        return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно добавлена']);
    }
    
    public function edit(int $id)
    {
        $this->authorize('manage', \App\Record::class);
        $categories = RecordsCategory::pluck('title','id')->all();
        $record = Record::findOrFail($id);
        $pageTitle = 'Редактировать ' . $record->title;
        return view('admin.records.records-edit', compact(['record', 'categories', 'pageTitle']));
    }
    
    public function update(StoreRecordRequest $request, int $id)
    {
        $this->authorize('manage', \App\Record::class);
        $record = Record::findOrFail($id);
        $record->title = $request->title;
        $record->description = $request->description;
        $record->short_description = $request->short_description;
        $record->category_id = $request->category;
        $record->titleSEO = $request->titleSEO;
        $record->descriptionSEO = $request->descriptionSEO;
        $record->keywordsSEO = $request->keywordsSEO;
        $record->save();
        $last_insereted_id = $record->id;
        if ($request->main_photo != null) {
            if($record->main_photo) {
                Storage::disk('uploaded_img')->delete($record->main_photo);
            }
            $record->main_photo = $request->main_photo->store('img/common/records/' . $last_insereted_id, ['disk' => 'uploaded_img']);
            $record->save();
        }
        return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно обновлена']);
    }
    
    public function destroy(int $id)
    {
        $this->authorize('manage', \App\Record::class);
        Storage::disk('uploaded_img')->deleteDirectory('img/common/records/' . $id);
        $record = Record::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.records.index')->with(['message' => 'Новость успешно удалена']);
    }
}
