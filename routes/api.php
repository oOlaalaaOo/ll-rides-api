<?php

use Illuminate\Http\Request;

/**
 * Vendor API
 */

Route::group([
	'prefix' => 'vendor',
	'middleware' => 'auth:sanctum'
], function () {
	Route::get('/', 'AuthController@me');

	Route::get('post/all', 'UserPostController@getUserPosts');
	Route::get('post/{id}/get', 'UserPostController@getUserPost');
	Route::post('post/create', 'UserPostController@createUserPost');
	Route::put('post/{id}/update', 'UserPostController@updateUserPost');
	Route::delete('post/{id}/delete', 'UserPostController@deleteUserPost');
});

Route::group(['prefix' => 'auth'], function () {
	Route::post('/register', 'AuthController@register');
	Route::post('/login', 'AuthController@login');
});

/**
 * Vendor API
 */