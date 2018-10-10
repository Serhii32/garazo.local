<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPagesController extends Controller
{
    public function index()
    {
    	$pageTitle = 'Главная';
    	return view('index', compact(['pageTitle']));
    }

    public function search(Request $request)
    {
    	$searchPhrase = $request->searchPhrase;
    	return view('search', compact(['searchPhrase']));
    }
}
