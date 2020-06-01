<?php

use Illuminate\Http\Request;

/**
 * Vendor API
 */
Route::group([
	'prefix' 			=> 'vendor',
	'namespace' 	=> 'Vendor'
], function () {
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');

	Route::group(['middleware' 	=> ['auth:api', 'scopes:role-vendor']], function() {
		Route::get('me', 'AuthController@me');
		Route::get('shop/all', 'ShopController@getShops');
		Route::get('shop/one', 'ShopController@getShop');
		Route::post('shop/create', 'ShopController@createShop');
		Route::post('shop/update', 'ShopController@updateShop');
		Route::post('shop/delete', 'ShopController@deleteShop');
	});
});


/**
 * Patron API
 */
Route::group([
	'prefix' 			=> 'patron',
	'middleware' 	=> ['auth:api', 'scopes:role-patron'],
	'namespace' 	=> 'Patron'
], function () {
	Route::get('me', 'AuthController@me');

	Route::get('post/all', 'PostController@getPosts');
	Route::get('post/one', 'PostController@getPost');
	Route::post('post/create', 'PostController@createPost');
	Route::post('post/update', 'PostController@updatePost');
	Route::post('post/delete', 'PostController@deletePost');
});
