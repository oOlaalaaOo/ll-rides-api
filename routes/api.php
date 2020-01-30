<?php

use Illuminate\Http\Request;

Route::post('/user/register', 'AuthController@register');
Route::post('/user/login', 'AuthController@login');

Route::middleware('auth:api')->group(function () {
	Route::get('/user', 'AuthController@me');

	Route::get('/user/post', 'UserPostController@index');
	Route::get('/user/post/{id}', 'UserPostController@show');
	Route::post('/user/post', 'UserPostController@store');
	Route::put('/user/post/{id}', 'UserPostController@update');
	Route::delete('/user/post/{id}', 'UserPostController@destroy');
});
