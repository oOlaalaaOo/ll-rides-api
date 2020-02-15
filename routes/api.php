<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->prefix('user')->group(function () {
	Route::get('', 'AuthController@me');

	Route::get('/post', 'UserPostController@index');
	Route::get('/post/{id}', 'UserPostController@show');
	Route::post('/post', 'UserPostController@store');
	Route::put('/post/{id}', 'UserPostController@update');
	Route::delete('/post/{id}', 'UserPostController@destroy');
});

Route::prefix('auth')->group(function () {
	Route::post('/register', 'AuthController@register');
	Route::post('/login', 'AuthController@login');
});
