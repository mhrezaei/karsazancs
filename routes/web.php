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

Route::group(['prefix' => 'manage', 'middleware' => ['auth', 'can:admin'], 'namespace' => 'Manage'], function () {
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
	| Customers
	*/

	Route::group(['prefix'=>'customers', 'middleware' => 'can:customers'] , function() {
		Route::get('/' , 'CustomersController@browse') ;
		Route::get('/browse/{request_tab?}' , 'CustomersController@browse') ;
		Route::get('/create/' , 'CustomersController@editor') ;
		Route::get('/search' , 'CustomersController@search');
		Route::get('/{user_id}/edit' , 'CustomersController@editor');
		Route::get('/{user_id}/{modal_action}' , 'CustomersController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'CustomersController@save');
			Route::post('/change_password' , 'CustomersController@change_password');
			Route::post('/soft_delete' , 'CustomersController@soft_delete');
			Route::post('/undelete' , 'CustomersController@undelete');
			Route::post('/hard_delete' , 'CustomersController@hard_delete');
			Route::post('/account' , 'CustomersController@account');
		});
	});

	/*
	| Currencies
	*/
	Route::group(['prefix'=>'currencies', 'middleware' => 'can:currencies'] , function() {
		Route::get('/' , 'CurrenciesController@browse') ;
		Route::get('/browse/{request_tab?}' , 'CurrenciesController@browse') ;
		Route::get('/create/' , 'CurrenciesController@editor') ;
		Route::get('/search' , 'CurrenciesController@search');
		Route::get('/{user_id}/edit' , 'CurrenciesController@editor');
		Route::get('/{user_id}/{modal_action}' , 'CurrenciesController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'CurrenciesController@save');
			Route::post('/update' , 'CurrenciesController@update');
			Route::post('/query' , 'CurrenciesController@query');
			Route::post('/soft_delete' , 'CurrenciesController@soft_delete');
			Route::post('/undelete' , 'CurrenciesController@undelete');
			Route::post('/hard_delete' , 'CurrenciesController@hard_delete');
		});
	});

	/*
	| Admins
	*/

	Route::group(['prefix'=>'admins', 'middleware' => 'can:super'] , function() {
		Route::get('/' , 'AdminsController@browse') ;
		Route::get('/browse/{request_tab?}' , 'AdminsController@browse') ;
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
	| SuperAdmin Settings
	*/
		Route::group(['prefix'=>'settings'  , 'middleware' => 'can:super'], function() {
			Route::get('/' , 'SettingsController@index') ;
			Route::get('/{request_tab}/' , 'SettingsController@index') ;//@TODO: INTACT

			Route::post('/save' , 'settingsController@save');

		});

	/*
	| Upstream Settings
	*/

	Route::group(['prefix' => 'upstream', 'middleware_' => 'can:developer'] , function() {
		Route::get('/{request_tab?}' , 'UpstreamController@index') ;
		Route::get('/{request_tab}/search/{keyword}' , 'UpstreamController@search') ;
		Route::get('/edit/{request_tab?}/{item_id?}/{parent_id?}' , 'UpstreamController@editor') ;
		Route::get('/{request_tab}/{item_id}' , 'UpstreamController@item') ;

		Route::group(['prefix' => 'save'] , function() {
			Route::post('state' , 'UpstreamController@saveProvince');
			Route::post('city' , 'UpstreamController@saveCity');
			Route::post('branch' , 'UpstreamController@saveBranch');
			Route::post('department' , 'UpstreamController@saveDepartment');
			Route::post('category' , 'UpstreamController@saveCategory');
			Route::post('downstream' , 'UpstreamController@saveDownstream');
			Route::post('downstream_value' , 'UpstreamController@setDownstream');
			Route::post('login_as' , 'UpstreamController@loginAs');
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