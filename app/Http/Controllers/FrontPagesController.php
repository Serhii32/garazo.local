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
use App\SEO_Page;

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
        $pageSEO = SEO_Page::where('page', '=', 'Главная')->first();
    	$pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
        $products = Product::paginate(12);
        $most_saled_last;
        $homeActive = true;
        if (count($products)) {
            $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
    	return view('index', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'homeActive', 'products', 'most_saled_last']));
    }

    public function search(Request $request)
    {
        $pageSEO = SEO_Page::where('page', '=', 'Поиск')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;

    	$searchPhrase = $request->searchPhrase;
        $products = Product::where('title', 'like', $searchPhrase.'%')->paginate(12);
        $most_saled_last;
        if (count($products)) {
            $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }

        $searchProductsCategories = ProductsCategory::where('title', 'like', $searchPhrase.'%')->paginate(12);

        $records = Record::where('title', 'like', $searchPhrase.'%')->paginate(6);

    	return view('search', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['searchPhrase', 'pageTitle', 'pageDescription', 'pageKeywords', 'products', 'most_saled_last', 'searchProductsCategories', 'records']));
    }

    public function cart()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Корзина')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
        $orderedProducts = Cart::getContent();
        return view('cart', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'orderedProducts']));
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
        $pageSEO = SEO_Page::where('page', '=', 'Оформить заказ')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
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
        $orderedProducts = Cart::getContent();
        $totalPrice = Cart::getSubTotal();
        $user = Auth::user();
        return view('order', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'orderedProducts', 'totalPrice', 'user']));
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
        $pageSEO = SEO_Page::where('page', '=', 'Доставка и оплата')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
        $deliveryActive = true;
        return view('delivery-payment', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'deliveryActive']));
    }

    public function about()
    {
        $pageSEO = SEO_Page::where('page', '=', 'О нас')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
        $aboutActive = true;
        return view('about', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'aboutActive']));
    }

    public function contacts()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Контакты')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
        $contactsActive = true;
        return view('contacts', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'contactsActive']));
    }

    public function productsServices()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Товары и услуги')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
        $productsActive = true;
        $products = Product::paginate(12);
        $productsActive = true;
        $most_saled_last;
        if (count($products)) {
            $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
        return view('products-services', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'products', 'productsActive', 'most_saled_last']));
    }

    public function categoryProductsServices(int $categoryId)
    {
        $products = Product::where('category_id', '=', $categoryId)->paginate(12);
        $productsCategory = ProductsCategory::findOrFail($categoryId);
        $pageTitle = $productsCategory->titleSEO;
        $pageDescription = $productsCategory->descriptionSEO;
        $pageKeywords = $productsCategory->keywordsSEO;
        $productsActive = true;
        $allProducts = Product::all();
        $most_saled_last;
        if (count($allProducts)) {
            $most_saled_last = $allProducts->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
        return view('products-services', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'productsCategory', 'productsActive', 'products', 'most_saled_last']));
    }

    public function productPage(int $productId)
    {
        $product = Product::findOrFail($productId);
        $pageTitle = $product->titleSEO;
        $pageDescription = $product->descriptionSEO;
        $productsActive = true;
        $pageKeywords = $product->keywordsSEO;
        $products = Product::all();
        $most_saled_last;
        if (count($products)) {
            $most_saled_last = $products->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
        return view('product-page', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'product', 'most_saled_last', 'productsActive', 'pageDescription', 'pageKeywords']));
    }

    public function promoAction()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Акции')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
        $allProducts = Product::all();
        $promoActive = true;
        $most_saled_last;
        if (count($allProducts)) {
            $most_saled_last = $allProducts->sortByDesc('most_saled')->take(5)->last()->most_saled;
        }
        $products = Product::where('promo_action', '=', '1')->paginate(12);
        return view('promo-action', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'promoActive', 'products', 'most_saled_last']));
    }

    public function records()
    {
        $pageSEO = SEO_Page::where('page', '=', 'Новости')->first();
        $pageTitle = $pageSEO->titleSEO;
        $pageDescription = $pageSEO->descriptionSEO;
        $pageKeywords = $pageSEO->keywordsSEO;
        $recordsActive = true;
        $records = Record::paginate(6);
        return view('records', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'recordsActive', 'records']));
    }

    public function categoryRecords(int $categoryId)
    {
        $records = Record::where('category_id', '=', $categoryId)->paginate(12);
        $recordsCategory = RecordsCategory::findOrFail($categoryId);
        $recordsActive = true;
        $pageTitle = $recordsCategory->titleSEO;
        $pageDescription = $recordsCategory->descriptionSEO;
        $pageKeywords = $recordsCategory->keywordsSEO;
        return view('records', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'pageDescription', 'pageKeywords', 'recordsActive', 'records']));
    }

    public function recordPage(int $recordId)
    {
        $record = Record::findOrFail($recordId);
        $pageTitle = $record->titleSEO;
        $recordsActive = true;
        $pageDescription = $record->descriptionSEO;
        $pageKeywords = $record->keywordsSEO;
        return view('record-page', ['productsCategories' => $this->productsCategories, 'recordsCategories' => $this->recordsCategories], compact(['pageTitle', 'recordsActive', 'record', 'pageDescription', 'pageKeywords']));
    }

}
