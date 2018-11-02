<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsCategory;
use App\RecordsCategory;
use App\Product;
use App\Record;
use Cart;
use App\Order;
use Illuminate\Support\Facades\Auth;

class FrontPagesController extends Controller
{
    private $productsCategories;

    public function __construct()
    {
        $this->productsCategories = ProductsCategory::all()->where('parent_id', '=', '0');
        $this->recordsCategories = RecordsCategory::all();
    }

    public function index()
    {
    	$pageTitle = 'Главная';
        $products = Product::paginate(12);
        $most_saled_last;
        if (count($products)) {
            $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
    	return view('index', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'products', 'most_saled_last']));
    }

    public function search(Request $request)
    {
        $pageTitle = 'Результаты поиска';
    	$searchPhrase = $request->searchPhrase;
    	return view('search', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['searchPhrase', 'pageTitle']));
    }

    public function cart()
    {
        $pageTitle = 'Корзина';
        $orderedProducts = Cart::getContent();
        return view('cart', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'orderedProducts']));
    }

    public function addToCart(int $productId, int $productQuantity = 1)
    {
        $product = Product::findOrFail($productId);
        Cart::add($productId, $product->title, $product->price, $productQuantity);
        return back();
    }

    public function deleteFromCart(int $productId)
    {
        Cart::remove($productId);
        return back();
    }

    public function order(Request $request)
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
        $pageTitle = 'Оформить заказ';
        $orderedProducts = Cart::getContent();
        $totalPrice = Cart::getSubTotal();
        $user = Auth::user();
        return view('order', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'orderedProducts', 'totalPrice', 'user']));
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

    public function deliveryPayment()
    {
        $pageTitle = 'Доставка и оплата';
        return view('delivery-payment', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle']));
    }

    public function about()
    {
        $pageTitle = 'О нас';
        return view('about', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle']));
    }

    public function productsServices()
    {
        $pageTitle = 'Товары и услуги';
        $products = Product::paginate(12);
        $most_saled_last;
        if (count($products)) {
            $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
        return view('products-services', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'products', 'most_saled_last']));
    }

    public function categoryProductsServices(int $categoryId)
    {
        $products = Product::where('category_id', '=', $categoryId)->paginate(12);
        $productsCategory = ProductsCategory::findOrFail($categoryId);
        $pageTitle = $productsCategory->titleSEO;
        $allProducts = Product::all();
        $most_saled_last;
        if (count($allProducts)) {
            $most_saled_last = $allProducts->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
        return view('products-services', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'products', 'most_saled_last']));
    }

    public function productPage(int $productId)
    {
        $product = Product::findOrFail($productId);
        $pageTitle = $product->titleSEO;
        $pageDescription = $product->descriptionSEO;
        $pageKeywords = $product->keywordsSEO;
        $products = Product::all();
        $most_saled_last;
        if (count($products)) {
            $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
        return view('product-page', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'product', 'most_saled_last', 'pageDescription', 'pageKeywords']));
    }

    public function promoAction()
    {
        $pageTitle = 'Акция';
        $allProducts = Product::all();
        $most_saled_last;
        if (count($allProducts)) {
            $most_saled_last = $allProducts->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
        $products = Product::where('promo_action', '=', '1')->paginate(12);
        return view('promo-action', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'products', 'most_saled_last']));
    }

    public function records()
    {
        $pageTitle = 'Новости';
        $records = Record::paginate(6);
        return view('records', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'records']));
    }

    public function categoryRecords(int $categoryId)
    {
        $records = Record::where('category_id', '=', $categoryId)->paginate(12);
        $recordsCategory = RecordsCategory::findOrFail($categoryId);
        $pageTitle = $recordsCategory->titleSEO;
        return view('records', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'records']));
    }

    public function recordPage(int $recordId)
    {
        $record = Record::findOrFail($recordId);
        $pageTitle = $record->titleSEO;
        $pageDescription = $record->descriptionSEO;
        $pageKeywords = $record->keywordsSEO;
        return view('record-page', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'record', 'pageDescription', 'pageKeywords']));
    }

}
