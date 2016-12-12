<?php

/*
|--------------------------------------------------------------------------
| Public Area Routes
|--------------------------------------------------------------------------
|
*/

Route::get('test' , 'TestController@index');

Route::group(['namespace' => 'Front', 'middleware' => ['Subdomain', 'UserIpDetect']], function () {
	// test
    Route::get('/hadi', 'UserController@test');
    Route::post('/hadi', 'FrontController@test2');

    Route::get('/', 'FrontController@index');
	Route::post('/register/new', 'FrontController@register');
	Route::get('/register/confirm/{hash}', 'UserController@register_confirm');
	Route::get('/pages/{slug}/{title?}', 'FrontController@pages');
    Route::get('/contact', 'FrontController@contact');
    Route::get('/faq', 'FrontController@faq');
    Route::get('/news', 'FrontController@news');
    Route::get('/products', 'FrontController@products');
    Route::get('/products/show/{id}', 'FrontController@show_products');

    Route::group(['middleware' => 'auth'], function (){
        Route::get('/profile', 'UserController@profile');
        Route::get('/user/edit', 'UserController@user_edit');
        Route::get('/user/password', 'UserController@user_password');
        Route::post('/user/password', 'UserController@user_password_set');
    });
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
		Route::get('/update/{item_id}' , 'PostsController@update');
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
	| Tickets
	*/
	Route::group(['prefix'=>'tickets'] , function() {
		Route::get('/update/{item_id}' , 'TicketsController@update');
		Route::get('{department_slug}/create/{user_id?}' , 'TicketsController@create');
		Route::get('/edit/{ticket_id}/{action?}' , 'TicketsController@modalActions');
		Route::get('/{department_slug}' , 'TicketsController@browse') ;
//		Route::get('{department_slug}/searched' , 'TicketsController@searchResult');
//		Route::get('{department_slug}/search' , 'TicketsController@searchPanel');
		Route::get('/{department_slug}/{request_tab}' , 'TicketsController@browse') ;

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'TicketsController@save');
			Route::post('/reply' , 'TicketsController@saveReply');
			Route::post('/soft_delete' , 'TicketsController@soft_delete');
			Route::post('/undelete' , 'TicketsController@undelete');
			Route::post('/hard_delete' , 'TicketsController@hard_delete');
		});
	});

	/*
	| Customers
	*/

	Route::group(['prefix'=>'customers', 'middleware' => 'can:customers'] , function() {
		Route::get('/update/{item_id}' , 'CustomersController@update');
		Route::get('/updateAccount/{item_id}' , 'CustomersController@updateAccount');
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
	| Products
	*/
	Route::group(['prefix'=>'products', 'middleware' => 'can:products'] , function() {
		Route::get('/update/{item_id}' , 'ProductsController@update');
		Route::get('/' , 'ProductsController@browse') ;
		Route::get('/browse/{request_tab?}' , 'ProductsController@browse') ;
		Route::get('/create/' , 'ProductsController@editor') ;
		Route::get('/search' , 'ProductsController@search');
		Route::get('/{user_id}/edit/{savable?}' , 'ProductsController@editor');
		Route::get('/{user_id}/{modal_action}' , 'ProductsController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'ProductsController@save');
			Route::post('/soft_delete' , 'ProductsController@soft_delete');
			Route::post('/undelete' , 'ProductsController@undelete');
			Route::post('/hard_delete' , 'ProductsController@hard_delete');
		});
	});


	/*
	| Orders
	*/
	Route::group(['prefix'=>'orders', 'middleware' => 'can:orders'] , function() {
		Route::get('/update/{item_id}' , 'OrdersController@update');
		Route::get('/' , 'OrdersController@browse') ;
		Route::get('/browse/{master?}/{request_tab?}' , 'OrdersController@browse') ;
		Route::get('/create/{product_id?}/{customer_id?}' , 'OrdersController@create') ;
//		Route::get('/search' , 'OrdersController@search');
		Route::get('/{product_id}/edit' , 'OrdersController@editor');
		Route::get('/{product_id}/{modal_action}' , 'OrdersController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
//			Route::post('/' , 'OrdersController@save');
			Route::post('/create' , 'OrdersController@createAction');
			Route::post('/new' , 'OrdersController@saveNew');
			Route::post('/soft_delete' , 'OrdersController@soft_delete');
			Route::post('/undelete' , 'OrdersController@undelete');
			Route::post('/hard_delete' , 'OrdersController@hard_delete');
		});
	});

	/*
	| Payments
	*/
	Route::group(['prefix'=>'payments', 'middleware' => 'can:payments'] , function() {
		Route::get('/update/{item_id}' , 'PaymentsController@update');
		Route::get('/' , 'PaymentsController@browse') ;
		Route::get('/browse/{master?}/{request_tab?}' , 'PaymentsController@browse') ;
		Route::get('/create/{order_id?}' , 'PaymentsController@create') ;
//		Route::get('/search' , 'PaymentsController@search');
		Route::get('/{product_id}/edit' , 'PaymentsController@editor');
		Route::get('/{user_id}/{modal_action}' , 'PaymentsController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'PaymentsController@save');
			Route::post('/create' , 'PaymentsController@createAction');
			Route::post('/process' , 'PaymentsController@process');
//			Route::post('/soft_delete' , 'PaymentsController@soft_delete');
//			Route::post('/undelete' , 'PaymentsController@undelete');
//			Route::post('/hard_delete' , 'PaymentsController@hard_delete');
		});
	});

	/*
	| Currencies
	*/
	Route::group(['prefix'=>'currencies', 'middleware' => 'can:currencies'] , function() {
		Route::get('/update/{item_id}' , 'CurrenciesController@update');
		Route::get('/' , 'CurrenciesController@browse') ;
		Route::get('/browse/{request_tab?}' , 'CurrenciesController@browse') ;
		Route::get('/create/' , 'CurrenciesController@editor') ;
		Route::get('/search' , 'CurrenciesController@search');
		Route::get('/{user_id}/edit' , 'CurrenciesController@editor');
		Route::get('/{user_id}/{modal_action}' , 'CurrenciesController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'CurrenciesController@save');
			Route::post('/update' , 'CurrenciesController@updateRate');
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
		Route::get('/update/{item_id}' , 'AdminsController@update');
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