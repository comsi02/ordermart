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
});

// for admin
Route::group(['middleware' => ['web','auth','admin']], function () {
    Route::get ('/company',                     ['as' => 'company_index',           'uses' => 'CompanyController@index']);

    Route::get ('/company/create',              ['as' => 'company_create',          'uses' => 'CompanyController@create']);
    Route::post('/company/create',              ['as' => 'company_create_submit',   'uses' => 'CompanyController@create_submit']);

    Route::get ('/company/edit/{id}',           ['as' => 'company_edit',            'uses' => 'CompanyController@edit']);
    Route::post('/company/edit',                ['as' => 'company_edit_submit',     'uses' => 'CompanyController@edit_submit']);
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

    Route::get ('/product/order/{salesman}',    ['as' => 'product_order',           'uses' => 'ProductController@order']);
    Route::get ('/product/order/view/{id}',     ['as' => 'product_order_view',      'uses' => 'ProductController@order_view']);
});

// for client
Route::group(['middleware' => ['web','auth','client']], function () {
    // order
    Route::get ('/order',                       ['as' => 'order_index',             'uses' => 'OrderController@index']);
    Route::post('/order/product',               ['as' => 'order_proudct',           'uses' => 'OrderController@product']);
});

