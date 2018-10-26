<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsCategory;
use App\Product;
use Cart;
use App\Order;
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
        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->status = 1;
        $order->delivery = $request->delivery;
        $order->payment = $request->payment;
        $order->totalSum = Cart::getSubTotal();
        if(Auth::check()){
            $user = Auth::user();
            $order->user_id = $user->id;
            if (!$user->phone) {
                $user->phone = $request->phone;
                $user->save();
            }
        }
        $order->save();
        $orderedProducts = Cart::getContent();
        foreach ($orderedProducts as $orderedProduct) {
            $order->products()->attach($orderedProduct->id, ['order_id' => $order->id, 'price' => $orderedProduct->price, 'quantity' => $orderedProduct->quantity]);
            $product = Product::findOrFail($orderedProduct->id);
            $product->most_saled += $orderedProduct->quantity;
            $product->save();
        }
        Cart::clear();
        return redirect()->route('page.index');
    }

}
