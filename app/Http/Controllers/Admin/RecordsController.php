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
        $records = Record::paginate(12);
        return view('admin.records.records-index', compact(['records']));
    }
    
    public function create()
    {
        $categories = RecordsCategory::pluck('title','id')->all();
        return view('admin.records.records-create', compact(['categories']));
    }
    
    // public function store(StoreRecordRequest $request)
    // {
    //     $item = new Blog();
    //     $item->title = $request->title;
    //     $item->description = $request->description;
    //     $item->short_description = $request->short_description;
    //     $item->category_id = $request->category;
    //     $item->save();
    //     $last_insereted_id = $item->id;
    //     if ($request->main_photo != null) {
    //         $item->main_photo = $request->main_photo->store('img/site/blog/' . $last_insereted_id);
    //         $item->save();
    //     }
    //     return redirect()->route('admin/blog.index')->with(['message' => 'Новина додана успішно']);
    // }
    
    // public function show(int $id)
    // {
    //     $item = Blog::findOrFail($id);
    //     return view('admin.blog.blog-show', compact(['item']));
    // }
    
    // public function edit(int $id)
    // {
    //     $categories = Category::pluck('title','id')->all();
    //     $item = Blog::findOrFail($id);
    //     return view('admin.blog.blog-edit', compact(['item', 'categories']));
    // }
    
    // public function update(StoreBlogRequest $request, int $id)
    // {
    //     $item = Blog::findOrFail($id);
    //     $item->title = $request->title;
    //     $item->description = $request->description;
    //     $item->short_description = $request->short_description;
    //     $item->category_id = $request->category;
    //     $item->save();
    //     $last_insereted_id = $item->id;
    //     if ($request->main_photo != null) {
    //         if($item->main_photo) {
    //             Storage::disk('local')->delete($item->main_photo);
    //         }
    //         $item->main_photo = $request->main_photo->store('img/site/blog/' . $last_insereted_id);
    //         $item->save();
    //     }
    //     return redirect()->route('admin/blog.index')->with(['message' => 'Новина успішно оновлена']);
    // }
    
    // public function destroy(int $id)
    // {
    //     Storage::disk('local')->deleteDirectory('img/site/blog/' . $id);
    //     $item = Blog::findOrFail($id);
    //     $item->delete();
    //     return redirect()->route('admin/blog.index')->with(['message' => 'Новина успішно видалена']);
    // }
}
