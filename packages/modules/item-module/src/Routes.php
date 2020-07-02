<?php

Route::group([
	'prefix' 		=> 'api',
	'namespace' 	=> 'Modules\ShopModule\Http\Controllers\Vendor'
], function () {
	Route::group(['middleware' 	=> ['auth:api', 'scopes:is-vendor']], function() {
		Route::get('shop/all', 'ShopController@getShops');
		Route::get('shop/one', 'ShopController@getShop');
		Route::post('shop/create', 'ShopController@createShop');
		Route::post('shop/update', 'ShopController@updateShop');
		Route::post('shop/delete', 'ShopController@deleteShop');
	});
});