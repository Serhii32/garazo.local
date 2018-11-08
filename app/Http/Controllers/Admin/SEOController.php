<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SEO_Page;
use App\Http\Requests\StoreSEORequest;

class SEOController extends Controller
{
    public function index()
    {
    	$pages = SEO_Page::all();
    	return view('admin.pagesSEO.pagesSEO-index', compact(['pages']));
    }

    public function update(StoreSEORequest $request)
    {

    	for($i = 1; $i <= (count($request->all())-2)/3; $i++){
    		$page = SEO_Page::findOrFail($i);
    		$page->titleSEO = $request->input('titleSEO_'.$i);
    		$page->descriptionSEO = $request->input('descriptionSEO_'.$i);
    		$page->keywordsSEO = $request->input('keywordsSEO_'.$i);
    		$page->save();
    	}

    	return redirect()->route('admin.pagesSEO.index')->with(['message' => 'SEO страниц успешно обновлено']);
    }

}
