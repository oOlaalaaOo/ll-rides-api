<?php

Route::group([
	'prefix' 		=> 'api/vendor/user',
	'namespace' 	=> 'Modules\UserModule\Http\Controllers\Vendor'
], function () {
	Route::group(['middleware' 	=> ['auth:api', 'scopes:is-vendor']], function() {
		Route::get('me', 'UserAuthController@me');

		Route::post('details/update', 'UserProfileController@updateUserDetails');
		Route::post('image/avatar/upload', 'UserProfileController@updateProfileAvatar');
		Route::post('image/main/upload', 'UserProfileController@updateProfileMainImg');
		Route::post('image/main/update', 'UserProfileController@updateUserDetails');
	});
});

// Route::group([
// 	'prefix' 		=> 'api/patron/user',
// 	'namespace' 	=> 'Modules\UserModule\Http\Controllers\Patron'
// ], function () {
// 	Route::group(['middleware' 	=> ['auth:api', 'scopes:is-patron']], function() {
// 		Route::get('me', 'UserAuthController@me');
// 	});
// });
