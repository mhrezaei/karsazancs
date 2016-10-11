<?php

/*
|--------------------------------------------------------------------------
| Public Area Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['namespace' => 'Front'], function () {
	Route::get('/', 'FrontController@index');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
*/

Auth::routes();
Route::get('home', 'Front\FrontController@redirectUsersAfterLogin');
Route::get('logout', 'Front\FrontController@logout');

/*
|--------------------------------------------------------------------------
| Routes for Registered Users
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| Routes for Admins
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'manage', 'middleware' => ['auth', 'admin'], 'namespace' => 'Manage'], function () {
	Route::get('/', 'ManageController@index');
	Route::get('index', 'ManageController@index');
	//    Route::get('upstream' , 'UpstreamController@index') ;


	Route::group(['prefix' => 'upstream', 'middleware_' => 'admin:developer'] , function() {
		Route::get('/{request_tab?}' , 'UpstreamController@index') ;
		Route::get('/edit/{request_tab?}/{item_id?}/{parent_id?}' , 'UpstreamController@editor') ;

		Route::group(['prefix' => 'save'] , function() {
			Route::post('states' , 'UpstreamController@saveStates');
		});
	});
});

/*
|        | POST     | login                        |                      | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | GET|HEAD | login                        | login                | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST     | logout                       |                      | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST     | password/email               |                      | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | POST     | password/reset               |                      | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD | password/reset               |                      | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | GET|HEAD | password/reset/{token}       |                      | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
 */