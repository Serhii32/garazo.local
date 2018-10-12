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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', ['as' => 'page.index', 'uses' => 'FrontPagesController@index']);
Route::post('search', ['as' => 'page.search', 'uses' => 'FrontPagesController@search']);

Auth::routes(['verify' => true]);

Route::group(['namespace' => 'Admin', 'middleware' => ['auth','verified'], 'as' => 'admin.', 'prefix'=>'admin'], function () {

	Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);
	Route::get('home/edit', ['as' => 'home.edit', 'uses' => 'HomeController@edit']);
	Route::match(['put', 'patch'], 'home/store', ['as' => 'home.update', 'uses' => 'HomeController@update']);
	
	Route::resource('productsCategories', 'ProductsCategoriesController')->except(['create', 'show']);

	Route::delete('/productsCategories/removeProductFromCategory/{productId}', ['as' => 'productsCategories.removeProductFromCategory', 'uses' => 'ProductsCategoriesController@removeProductFromCategory']);

	Route::resource('recordsCategories', 'RecordsCategoriesController')->except(['create', 'show']);

	Route::delete('/recordsCategories/removeRecordFromCategory/{recordId}', ['as' => 'recordsCategories.removeRecordFromCategory', 'uses' => 'RecordsCategoriesController@removeRecordFromCategory']);

	Route::post('upload-image', ['as' => 'upload-image', 'uses' => 'CKEditorImageUploadController@uploadImage']);
	Route::get('uploaded-images', ['as' => 'uploaded-images.index', 'uses' => 'CKEditorImageUploadController@index']);
	Route::delete('uploaded-images/{imageName}', ['as' => 'uploaded-images.destroy', 'uses' => 'CKEditorImageUploadController@destroy']);

	Route::resource('records', 'RecordsController')->except(['show']);
	Route::resource('products', 'RecordsController')->except(['show']);

});

Route::group(['namespace' => 'User', 'middleware' => ['auth','verified'], 'as' => 'user.', 'prefix'=>'user'], function () {

	Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);
	Route::get('home/edit', ['as' => 'home.edit', 'uses' => 'HomeController@edit']);
	Route::match(['put', 'patch'], 'home/store', ['as' => 'home.update', 'uses' => 'HomeController@update']);

});

//add policies and authorization in requests
//add captcha when registering
//create good head on pages with all headers
//admin email, where orders sending
//admin and user page with nofollow noindex tag
//admin can delete users with message to email
//most saled every order of the product will increase by one
//add seo options in admin panel
//add possibility to add atributes to goods like in wordpress
