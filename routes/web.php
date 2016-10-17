<?php

/*
|--------------------------------------------------------------------------
| Public Area Routes
|--------------------------------------------------------------------------
|
*/

Route::get('test' , 'TestController@index');

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


	/*
	| Posts
	*/
	Route::group(['prefix'=>'posts'] , function() {
		Route::get('/{branch_slug}' , 'PostsController@browse') ;
		Route::get('{branch_slug}/edit/{post_id}' , 'PostsController@editor');
		Route::get('{branch_slug}/searched' , 'PostsController@searchResult');
		Route::get('{branch_slug}/search' , 'PostsController@searchPanel');
		Route::get('/{branch_slug}/{request_tab}/{request_category?}' , 'PostsController@browse') ;

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'PostsController@save');
			Route::post('/hard_delete' , 'PostsController@hard_delete');
		});
	});

	/*
	| Admins
	*/

	Route::group(['prefix'=>'admins'] , function() { //@TODO: Middleware to check permission
		Route::get('/' , 'AdminsController@browse') ;
		Route::get('/browse' , 'AdminsController@browse') ;
		Route::get('/browse/{request_tab}' , 'AdminsController@browse') ;
		Route::get('/create/' , 'AdminsController@editor') ;
		Route::get('/search' , 'AdminsController@search');
//		Route::get('/reports' , 'AdminsController@reports');
		Route::get('/{user_id}/edit' , 'AdminsController@editor');
		Route::get('/{user_id}/{modal_action}' , 'AdminsController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'AdminsController@save');

			Route::post('/change_password' , 'AdminsController@change_password');
			Route::post('/soft_delete' , 'AdminsController@soft_delete');
			Route::post('/undelete' , 'AdminsController@undelete');
			Route::post('/hard_delete' , 'AdminsController@hard_delete');
			Route::post('/permits' , 'AdminsController@permits');
		});
	});



	/*
	| Upstream Settings
	*/

	Route::group(['prefix' => 'upstream', 'middleware_' => 'admin:developer'] , function() {
		Route::get('/{request_tab?}' , 'UpstreamController@index') ;
		Route::get('/{request_tab}/search/{keyword}' , 'UpstreamController@search') ;
		Route::get('/edit/{request_tab?}/{item_id?}/{parent_id?}' , 'UpstreamController@editor') ;
		Route::get('/{request_tab}/{item_id}' , 'UpstreamController@item') ;

		Route::group(['prefix' => 'save'] , function() {
			Route::post('state' , 'UpstreamController@saveProvince');
			Route::post('city' , 'UpstreamController@saveCity');
			Route::post('branch' , 'UpstreamController@saveBranch');
			Route::post('category' , 'UpstreamController@saveCategory');
			Route::post('downstream' , 'UpstreamController@saveDownstream');
			Route::post('downstream_value' , 'UpstreamController@setDownstream');
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