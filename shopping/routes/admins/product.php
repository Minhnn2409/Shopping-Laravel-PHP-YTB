<?php

// PRODUCTS
Route::prefix('products')->group(function () {
    Route::get('/', [
        'as' => 'product.index',
        'uses' => 'App\Http\Controllers\ProductController@index',
        'middleware' => 'can:product-list'
    ]);

    Route::get('/create', [
        'as' => 'product.create',
        'uses' => 'App\Http\Controllers\ProductController@create'
    ]);

    Route::post('/store', [
        'as' => 'product.store',
        'uses' => 'App\Http\Controllers\ProductController@store'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'product.edit',
        'uses' => 'App\Http\Controllers\ProductController@edit',
        'middleware' => 'can:product-edit,id'
    ]);

    Route::post('/update/{id}', [
        'as' => 'product.update',
        'uses' => 'App\Http\Controllers\ProductController@update'
    ]);

    Route::get('/delete/{id}', [
        'as' => 'product.delete',
        'uses' => 'App\Http\Controllers\ProductController@delete'
    ]);

});
