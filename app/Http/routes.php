<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');

    // fileupload
    Route::post('/common/s3_file_upload',       ['as' => 's3_file_upload',          'uses' => 'Common@s3_file_upload']);
});

// for admin
Route::group(['middleware' => ['web','auth','admin']], function () {
    // 거래처 관리
    Route::get ('/company',                     ['as' => 'company_index',           'uses' => 'CompanyController@index']);
    Route::get ('/company/create',              ['as' => 'company_create',          'uses' => 'CompanyController@create']);
    Route::post('/company/create',              ['as' => 'company_create_submit',   'uses' => 'CompanyController@create_submit']);
    Route::get ('/company/edit/{id}',           ['as' => 'company_edit',            'uses' => 'CompanyController@edit']);
    Route::post('/company/edit',                ['as' => 'company_edit_submit',     'uses' => 'CompanyController@edit_submit']);

    // 사용자 관리
    Route::get ('/person',                      ['as' => 'person_index',            'uses' => 'PersonController@index']);
    Route::get ('/person/edit/{id}',            ['as' => 'person_edit',             'uses' => 'PersonController@edit']);
    Route::post('/person/edit',                 ['as' => 'person_edit_submit',      'uses' => 'PersonController@edit_submit']);
});

// for salesman
Route::group(['middleware' => ['web','auth','salesman']], function () {
    Route::get ('/product',                     ['as' => 'product_index',           'uses' => 'ProductController@index']);
    Route::get ('/product/view/{id}',           ['as' => 'product_view',            'uses' => 'ProductController@view']);

    Route::get ('/product/create',              ['as' => 'product_create',          'uses' => 'ProductController@create']);
    Route::post('/product/create',              ['as' => 'product_create_submit',   'uses' => 'ProductController@create_submit']);

    Route::get ('/product/edit/{id}',           ['as' => 'product_edit',            'uses' => 'ProductController@edit']);
    Route::post('/product/edit',                ['as' => 'product_edit_submit',     'uses' => 'ProductController@edit_submit']);

    Route::post('/product/destory',             ['as' => 'product_destory',         'uses' => 'ProductController@destory']);

    Route::get ('/product/order',               ['as' => 'product_order',           'uses' => 'ProductController@order']);
    Route::get ('/product/order/view/{id}',     ['as' => 'product_order_view',      'uses' => 'ProductController@order_view']);
});

// for client
Route::group(['middleware' => ['web','auth','client']], function () {
    // Profile
    Route::get ('/profile',                     ['as' => 'profile',                 'uses' => 'PersonController@profile']);
    Route::post('/profile',                     ['as' => 'profile_submit',          'uses' => 'PersonController@profile_submit']);

    // 주문
    Route::get ('/order/company',               ['as' => 'order_company',           'uses' => 'OrderController@company']);
    Route::get ('/order/person/{company_id}',   ['as' => 'order_person',            'uses' => 'OrderController@person']);
    Route::get ('/order/product/{user_id}',     ['as' => 'order_product',           'uses' => 'OrderController@product']);
    Route::get ('/order/product/view/{id}',     ['as' => 'order_product_view',      'uses' => 'OrderController@product_view']);
    Route::post('/order/product',               ['as' => 'order_product_submit',    'uses' => 'OrderController@product_submit']);
});

