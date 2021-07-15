<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ADMIN
Route::prefix('admin')->group(function () {

    Route::get('/', 'App\Http\Controllers\AdminController@index');
    Route::post('/', [
        'as' => 'admin.login',
        'uses' => 'App\Http\Controllers\AdminController@loginAccessed'
    ]);

    Route::get('/logout', [
        'as' => 'admin.logout',
        'uses' => 'App\Http\Controllers\AdminController@logoutAccess'
    ]);

    //CATEGORIES
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'category.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware' => 'can:category-list'
        ]);

        Route::get('/create', [
            'as' => 'category.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware' => 'can:category-add'
        ]);
        Route::post('/store', [
            'as' => 'category.store',
            'uses' => 'App\Http\Controllers\CategoryController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'category.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware' => 'can:category-edit'

        ]);
        Route::post('/update/{id}', [
            'as' => 'category.update',
            'uses' => 'App\Http\Controllers\CategoryController@update',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'category.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);
    });

    //MENUS
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menu.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
        ]);

        Route::get('/store', [
            'as' => 'menu.store',
            'uses' => 'App\Http\Controllers\MenuController@store',
        ]);

        Route::get('/create', [
            'as' => 'menu.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
        ]);

        Route::post('/store', [
            'as' => 'menu.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'menu.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'menu.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);

        Route::get('/delete{id}', [
            'as' => 'menu.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete'
        ]);
    });



    // SLIDERS
    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'slider.index',
            'uses' => 'App\Http\Controllers\SliderController@index',
        ]);

        Route::get('/add', [
            'as' => 'slider.add',
            'uses' => 'App\Http\Controllers\SliderController@add'
        ]);

        Route::post('/create', [
            'as' => 'slider.create',
            'uses' => 'App\Http\Controllers\SliderController@create'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'slider.edit',
            'uses' => 'App\Http\Controllers\SliderController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'slider.update',
            'uses' => 'App\Http\Controllers\SliderController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'slider.delete',
            'uses' => 'App\Http\Controllers\SliderController@delete'
        ]);
    });

    //SETTINGS
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'setting.index',
            'uses' => 'App\Http\Controllers\SettingController@index'
        ]);

        Route::get('/add', [
            'as' => 'setting.add',
            'uses' => 'App\Http\Controllers\SettingController@add'
        ]);

        Route::post('/create', [
            'as' => 'setting.create',
            'uses' => 'App\Http\Controllers\SettingController@create'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'setting.edit',
            'uses' => 'App\Http\Controllers\SettingController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'setting.update',
            'uses' => 'App\Http\Controllers\SettingController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'setting.delete',
            'uses' => 'App\Http\Controllers\SettingController@delete'
        ]);

    });

    //Users
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'user.index',
            'uses' => 'App\Http\Controllers\UserController@index'
        ]);

        Route::get('/add', [
            'as' => 'user.add',
            'uses' => 'App\Http\Controllers\UserController@add'
        ]);

        Route::post('/create', [
            'as' => 'user.create',
            'uses' => 'App\Http\Controllers\UserController@create'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.edit',
            'uses' => 'App\Http\Controllers\UserController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'user.update',
            'uses' => 'App\Http\Controllers\UserController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'user.delete',
            'uses' => 'App\Http\Controllers\UserController@delete'
        ]);

    });

    //Roles
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'role.index',
            'uses' => 'App\Http\Controllers\RoleController@index'
        ]);

        Route::get('/add', [
            'as' => 'role.add',
            'uses' => 'App\Http\Controllers\RoleController@add'
        ]);

        Route::post('/create', [
            'as' => 'role.create',
            'uses' => 'App\Http\Controllers\RoleController@create'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'role.edit',
            'uses' => 'App\Http\Controllers\RoleController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'role.update',
            'uses' => 'App\Http\Controllers\RoleController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'role.delete',
            'uses' => 'App\Http\Controllers\RoleController@delete'
        ]);

    });

    //Permissions
    Route::prefix('permissions')->group(function () {

        Route::get('/add', [
            'as' => 'permission.add',
            'uses' => 'App\Http\Controllers\PermissionController@add'
        ]);

        Route::post('/store', [
            'as' => 'permission.store',
            'uses' => 'App\Http\Controllers\PermissionController@store'
        ]);

    });

});




