<?php

Route::group([
	'prefix' => 'vendor/shop',
	'namespace' => 'Vendor',
	// 'middleware' => ['auth:api', 'scopes:is-vendor']
], function () {
	Route::get('/', 'ShopController@index');
	Route::get('{id}', 'ShopController@show');
	Route::post('create', 'ShopController@store');
	Route::post('{id}/update', 'ShopController@update');
	Route::post('{id}/delete', 'ShopController@destroy');
});