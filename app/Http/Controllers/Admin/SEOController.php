<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SEO_Page;

class SEOController extends Controller
{
    public function index()
    {
    	$pages = SEO_Page::all();
    	return view('admin.pagesSEO.pagesSEO-index', compact(['pages']));
    }
}
