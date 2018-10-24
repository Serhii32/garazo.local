<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsCategory;
use App\Product;
use Cart;

class FrontPagesController extends Controller
{
    private $productsCategories;

    public function __construct()
    {
        $this->productsCategories = ProductsCategory::all()->where('parent_id', '=', '0');
    }

    public function index()
    {
    	$pageTitle = 'Главная';
        $products = Product::paginate(12);
        $most_saled_last;
        if (count($products)) {
            $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
    	return view('index', ['productsCategories' => $this->productsCategories], compact(['pageTitle', 'products', 'most_saled_last']));
    }

    public function search(Request $request)
    {
        $pageTitle = 'Результаты поиска';
    	$searchPhrase = $request->searchPhrase;
    	return view('search', compact(['searchPhrase', 'pageTitle']));
    }

    public function cart()
    {
        $pageTitle = 'Корзина';
        $orderedProducts = Cart::getContent();
        return view('cart', ['productsCategories' => $this->productsCategories], compact(['pageTitle', 'orderedProducts']));
    }

    public function addToCart(int $productId, int $productQuantity = 1)
    {
    
        $product = Product::findOrFail($productId);
        Cart::add($productId, $product->title, $product->price, $productQuantity);

        // Cart::add(array(
        //     'id' => 456,
        //     'name' => 'Sample Item',
        //     'price' => 67.99,
        //     'quantity' => 4,
        //     'attributes' => array()
        // ));
        

        return back();
    }

    public function postOrder()
    {
        
    }
}
