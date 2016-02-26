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

    // product
    Route::get ('/product',                 ['as' => 'product_index',           'uses' => 'ProductController@index']);
    Route::get ('/product/view/{id}',       ['as' => 'product_view',            'uses' => 'ProductController@view']);

    Route::get ('/product/create',          ['as' => 'product_create',          'uses' => 'ProductController@create']);
    Route::post('/product/create',          ['as' => 'product_create_submit',   'uses' => 'ProductController@create_submit']);

    Route::get ('/product/edit/{id}',       ['as' => 'product_edit',            'uses' => 'ProductController@edit']);
    Route::post('/product/edit',            ['as' => 'product_edit_submit',     'uses' => 'ProductController@edit_submit']);

    Route::get ('/product/destory/{id}',    ['as' => 'product_destory',         'uses' => 'ProductController@destory']);
    Route::post('/product/destory',         ['as' => 'product_destory_submit',  'uses' => 'ProductController@destory_submit']);
});

