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

});

Route::group(['namespace' => 'User', 'middleware' => ['auth','verified'], 'as' => 'user.', 'prefix'=>'user'], function () {

	Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);
	Route::get('home/edit', ['as' => 'home.edit', 'uses' => 'HomeController@edit']);
	Route::match(['put', 'patch'], 'home/store', ['as' => 'home.update', 'uses' => 'HomeController@update']);

});

//add policies
//add captcha when registering
//add user email verification when register and when email changed
//create good head on pages with all headers
//admin email, where orders sending
//admin and user page with nofollow tag
