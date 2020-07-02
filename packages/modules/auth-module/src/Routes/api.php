<?php

Route::group([
	'prefix' 		=> 'vendor/auth',
	'namespace' 	=> 'Vendor',
], function () {
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
});
