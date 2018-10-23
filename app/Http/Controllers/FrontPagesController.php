<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsCategory;
use App\Product;
use Cart;

class FrontPagesController extends Controller
{
    public function index()
    {
        $productsCategories = ProductsCategory::all()->where('parent_id', '=', '0');
    	$pageTitle = 'Главная';
        $products = Product::paginate(12);
        $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
    	return view('index', compact(['pageTitle', 'productsCategories', 'products', 'most_saled_last']));
    }

    public function search(Request $request)
    {
    	$searchPhrase = $request->searchPhrase;
    	return view('search', compact(['searchPhrase']));
    }

    public function addToCart(int $productId = null)
    {
        if ($productId) 
        {
            $product = Product::findOrFail($productId);
            Cart::add($productId, $product->title, $product->price, 1);

            // Cart::add(array(
            //     'id' => 456,
            //     'name' => 'Sample Item',
            //     'price' => 67.99,
            //     'quantity' => 4,
            //     'attributes' => array()
            // ));
        }
        
        $cartItems = Cart::getContent();

        return back();
    }
}
