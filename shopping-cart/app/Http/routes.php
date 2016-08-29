<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index'
]);

Route::get('/add-to-cart/{id}', [
    'uses' => 'ProductController@getAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('/reduce/{id}', [
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}', [
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove'
]);

Route::get('/shopping-cart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('/checkout', [
    'uses' => 'ProductController@getCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);

Route::post('/checkout', [
    'uses' => 'ProductController@postCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);

        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);

        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);

        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [
            'uses' => 'UserController@getProfile',
            'as' => 'user.profile'
        ]);

        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);
    });
});

/*==========For Admin  Category ============*/

Route::get('/categories',[
    'uses'=>'CategoriesController@getCategories',
    'as'=>'categories.index',
    'middleware' => 'auth'
    ]);

Route::post('/categories',[
    'uses'=>'CategoriesController@postDeleteOrUpdate',
    'as'=>'categories.updateOrdelete'
    
]);

Route::post('/categories/add',[
    'uses'=>'CategoriesController@postAdd',
    'as'=>'categories.add'
]);

/*
==========for Products  Admin only==================*/


Route::get('/products',[
    'uses'=>'ProductController@getProducts',
    'as'=>'admin.products.index',
    'middleware' => 'auth'
]);

Route::get('/category-products/{id}',[
    'uses'=>'ProductController@getProductsByCategory',
    'as'=>'admin.products.display.by.category',
    'middleware' => 'auth'
]);


Route::post('/products',[
    'uses'=>'ProductController@postDeleteOrUpdate',
    'as'=>'products.updateOrdelete'

]);


Route::post('/products/add',[
    'uses'=>'ProductController@postAdd',
    'as'=>'products.add'
]);

/*
===============Search===========*/
Route::post('/products-search',[
    'uses'=>'ProductController@postSearch',
    'as'=>'products.search'
]);

Route::get('/products-search',[
    'uses'=>'ProductController@getSearch',
    'as'=>'products.search'
]);


