<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'page.index', 'uses' => 'FrontPagesController@index']);

Route::get('cart', ['as' => 'page.cart', 'uses' => 'FrontPagesController@cart']);

Route::get('delivery-payment', ['as' => 'page.delivery-payment', 'uses' => 'FrontPagesController@deliveryPayment']);

Route::get('products-services', ['as' => 'page.products-services', 'uses' => 'FrontPagesController@productsServices']);

Route::get('products-category-page/{categoryId}', ['as' => 'page.products-category', 'uses' => 'FrontPagesController@categoryProductsServices']);

Route::get('promo-action', ['as' => 'page.promo-action', 'uses' => 'FrontPagesController@promoAction']);

Route::get('product-page/{productId}', ['as' => 'page.product', 'uses' => 'FrontPagesController@productPage']);

Route::get('records', ['as' => 'page.records', 'uses' => 'FrontPagesController@records']);

Route::get('records-category-page/{categoryId}', ['as' => 'page.records-category', 'uses' => 'FrontPagesController@categoryRecords']);

Route::get('record-page/{recordId}', ['as' => 'page.record', 'uses' => 'FrontPagesController@recordPage']);

Route::get('about', ['as' => 'page.about', 'uses' => 'FrontPagesController@about']);

Route::get('contacts', ['as' => 'page.contacts', 'uses' => 'FrontPagesController@contacts']);

Route::get('search', ['as' => 'page.search', 'uses' => 'FrontPagesController@search']);

Route::post('addToCart/{productId}/{productQuantity?}', ['as' => 'add-to-cart', 'uses' => 'FrontPagesController@addToCart']);

Route::get('deleteFromCart/{productId}', ['as' => 'delete-from-cart', 'uses' => 'FrontPagesController@deleteFromCart']);

Route::match(['get', 'put', 'patch'], 'order', ['as' => 'page.order', 'uses' => 'FrontPagesController@order']);

Route::post('makeOrder', ['as' => 'make-order', 'uses' => 'FrontPagesController@makeOrder']);

Auth::routes(['verify' => true]);

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'isAdmin'], 'as' => 'admin.', 'prefix'=>'admin'], function () {

	Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);
	Route::get('home/edit', ['as' => 'home.edit', 'uses' => 'HomeController@edit']);
	Route::match(['put', 'patch'], 'home/store', ['as' => 'home.update', 'uses' => 'HomeController@update']);
	
	Route::group(['middleware' => 'verified'], function () {

		Route::resource('productsCategories', 'ProductsCategoriesController')->except(['create', 'show']);

		Route::delete('productsCategories/removeProductFromCategory/{productId}', ['as' => 'productsCategories.removeProductFromCategory', 'uses' => 'ProductsCategoriesController@removeProductFromCategory']);

		Route::resource('recordsCategories', 'RecordsCategoriesController')->except(['create', 'show']);

		Route::delete('recordsCategories/removeRecordFromCategory/{recordId}', ['as' => 'recordsCategories.removeRecordFromCategory', 'uses' => 'RecordsCategoriesController@removeRecordFromCategory']);

		Route::post('upload-image', ['as' => 'upload-image', 'uses' => 'CKEditorImageUploadController@uploadImage']);
		Route::get('uploaded-images', ['as' => 'uploaded-images.index', 'uses' => 'CKEditorImageUploadController@index']);
		Route::delete('uploaded-images/{imageName}', ['as' => 'uploaded-images.destroy', 'uses' => 'CKEditorImageUploadController@destroy']);
		
		Route::resource('records', 'RecordsController')->except(['show']);

		Route::get('products/productAttributeDestroy/{productId}/{attributeNameId}/{attributeValueId}', ['as' => 'products.productAttributeDestroy', 'uses' => 'ProductsController@productAttributeDestroy']);

		Route::resource('products', 'ProductsController')->except(['show']);

		Route::resource('attributes', 'AttributesController')->except(['show']);

		Route::get('users', ['as' => 'users.index', 'uses' => 'UsersController@index']);

		Route::get('users/{user}/show', ['as' => 'users.show', 'uses' => 'UsersController@show']);

		Route::delete('users/{user}', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);

		Route::get('orders', ['as' => 'orders.index', 'uses' => 'OrdersController@index']);

		Route::match(['put', 'patch'], 'orders/{order}', ['as' => 'orders.update', 'uses' => 'OrdersController@update']);

		Route::delete('orders/{order}', ['as' => 'orders.destroy', 'uses' => 'OrdersController@destroy']);

		Route::get('pagesSEO', ['as' => 'pagesSEO.index', 'uses' => 'SEOController@index']);

		Route::put('pagesSEO/update', ['as' => 'pagesSEO.update', 'uses' => 'SEOController@update']);

	});

});

Route::group(['namespace' => 'User', 'middleware' => ['auth', 'isUser'], 'as' => 'user.', 'prefix'=>'user'], function () {

	Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);
	Route::get('home/edit', ['as' => 'home.edit', 'uses' => 'HomeController@edit']);
	Route::match(['put', 'patch'], 'home/store', ['as' => 'home.update', 'uses' => 'HomeController@update']);
	Route::delete('home/destroy', ['as' => 'home.destroy', 'uses' => 'HomeController@destroy']);
	Route::delete('home/destroy-order/{order}', ['as' => 'home.destroy-order', 'uses' => 'HomeController@destroyOrder']);

});

//add captcha when registering
//create good head on pages with all headers
//admin email, where orders sending
//admin and user page with nofollow noindex tag
//admin can delete users with message to email
//change error pages in views
//style delivery-payment page
//add request for order
//add attributes and orders policies
//style records page
//add attributes managing values
//add request to search and SEOpages