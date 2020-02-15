<?php

use Illuminate\Http\Request;

/**
 * Members API
 */

Route::middleware('auth:api')->prefix('user')->group(function () {
	Route::get('/', 'AuthController@me');

	Route::get('/post', 'UserPostController@getUserPosts');
	Route::get('/post/{id}', 'UserPostController@getUserPost');
	Route::post('/post', 'UserPostController@storeUserPost');
	Route::put('/post/{id}', 'UserPostController@updateUserPost');
	Route::delete('/post/{id}', 'UserPostController@destroyUserPost');
});

Route::prefix('auth')->group(function () {
	Route::post('/register', 'AuthController@register');
	Route::post('/login', 'AuthController@login');
});

/**
 * Members API
 */