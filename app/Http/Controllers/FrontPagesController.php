<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsCategory;
use App\Product;
use Cart;
use Illuminate\Support\Facades\Auth;

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
        return back();
    }

    public function order(Request $request = null)
    {
        if($request)
        {
            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'itemQuantity') !== false) {
                    preg_match('/\d+$/', $key, $matches);
                    Cart::update($matches[0], array(
                        'quantity' => array(
                            'relative' => false,
                            'value' => $value
                        ),
                    ));
                }
            }
        }
        $pageTitle = 'Оформить заказ';
        $orderedProducts = Cart::getContent();
        $totalPrice = Cart::getSubTotal();
        $user = Auth::user();
        return view('order', ['productsCategories' => $this->productsCategories], compact(['pageTitle', 'orderedProducts', 'totalPrice', 'user']));
    }

    public function makeOrder(Request $request)
    {
        if(Auth::check()){
            $user = Auth::user();
        } else {

        }
        $orderedProducts = Cart::getContent();
        dd($request->all());
    }

}
