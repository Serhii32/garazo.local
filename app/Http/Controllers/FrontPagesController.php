<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsCategory;

class FrontPagesController extends Controller
{
    public function index()
    {
        $productsCategories = ProductsCategory::all()->where('parent_id', '=', '0');
    	$pageTitle = 'Главная';
    	return view('index', compact(['pageTitle', 'productsCategories']));
    }

    public function search(Request $request)
    {
    	$searchPhrase = $request->searchPhrase;
    	return view('search', compact(['searchPhrase']));
    }
}
