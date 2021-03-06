<?php

use Illuminate\Routing\RouteGroup;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('/');

Route::get('admin/login', 'AdminController@login')->name('admin.login');
Route::post('admin/login', 'AdminController@postLogin');

Route::get('admin/home', function () {
    return view('home');
});

// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'CategoryController@index'
        ]);
    
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'CategoryController@create'
        ]);
    
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'CategoryController@store'
        ]);
    
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'CategoryController@edit'
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'CategoryController@update'
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'CategoryController@delete'
        ]);
    });
    
    route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'MenuController@index'
        ]);
    
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'MenuController@create'
        ]);
    
        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);
    
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit'
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete'
        ]);
    });

    route::prefix('products')->group(function () {
        Route::get('/', [
            'as' => 'products.index',
            'uses' => 'AdminProductController@index'
        ]);
    
        Route::get('/create', [
            'as' => 'products.create',
            'uses' => 'AdminProductController@create'
        ]);
    
        Route::post('/store', [
            'as' => 'products.store',
            'uses' => 'AdminProductController@store'
        ]);
    
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'uses' => 'AdminProductController@edit'
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'AdminProductController@update'
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'uses' => 'AdminProductController@delete'
        ]);
    });

    route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'sliders.index',
            'uses' => 'AdminSliderController@index'
        ]);
    
        Route::get('/create', [
            'as' => 'sliders.create',
            'uses' => 'AdminSliderController@create'
        ]);
    
        Route::post('/store', [
            'as' => 'sliders.store',
            'uses' => 'AdminSliderController@store'
        ]);
    
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'uses' => 'AdminSliderController@edit'
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'AdminSliderController@update'
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'uses' => 'AdminSliderController@delete'
        ]);
    });

    route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'AdminSettingController@index'
        ]);
    
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'AdminSettingController@create'
        ]);
    
        Route::post('/store', [
            'as' => 'settings.store',
            'uses' => 'AdminSettingController@store'
        ]);
    
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'uses' => 'AdminSettingController@edit'
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'AdminSettingController@update'
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'uses' => 'AdminSettingController@delete'
        ]);
    });

    route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index'
        ]);
    
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create'
        ]);
    
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);
    
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit'
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete'
        ]);
    });
    
    route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRoleController@index',
            'middleware' => 'can:role_view'
        ]);
    
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRoleController@create',
            'middleware' => 'can:role_add'
        ]);
    
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);
    
        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRoleController@edit',
            'middleware' => 'can:role_edit'
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'AdminRoleController@update'
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'AdminRoleController@delete',
            'middleware' => 'can:role_delete'
        ]);
    });

    route::prefix('permissions')->group(function () {
        Route::get('/', [
            'as' => 'permissions.index',
            'uses' => 'AdminPermissionController@index'
        ]);
    
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionController@create'
        ]);
    
        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionController@store'
        ]);
    
        Route::get('/edit/{id}', [
            'as' => 'permissions.edit',
            'uses' => 'AdminPermissionController@edit'
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'permissions.update',
            'uses' => 'AdminPermissionController@update'
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'permissions.delete',
            'uses' => 'AdminPermissionController@delete'
        ]);
    });

});

// Frontent
Route::group(['prefix' => '/'], function () {
    Route::get('/', [
        'as' => 'home.index',
        'uses' => 'Frontend\HomeController@index'
    ]);
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [
        'as' => 'cart.index',
        'uses' => 'Frontend\CartController@index'
    ]);
    Route::get('add', [
        'as' => 'cart.add',
        'uses' => 'Frontend\CartController@add'
    ]);

    Route::post('postAdd', [
        'as' => 'cart.postAdd',
        'uses' => 'Frontend\CartController@postAdd'
    ]);
    Route::get('update', [
        'as' => 'cart.update',
        'uses' => 'Frontend\CartController@update'
    ]);
    Route::get('delete', [
        'as' => 'cart.delete',
        'uses' => 'Frontend\CartController@delete'
    ]);
    Route::get('checkout', [
        'as' => 'cart.checkout',
        'uses' => 'Frontend\CartController@getCheckout'
    ]);
    Route::post('checkout', [
        'as' => 'cart.checkout',
        'uses' => 'Frontend\CartController@postCheckout'
    ]);
});

Route::group(['prefix' => 'category'], function () {
    Route::get('/{slug}/{id}', [
        'as' => 'category.index',
        'uses' => 'Frontend\CategoryController@index'
    ]);
});

Route::get('product-detail/{slug}/{id}', [
    'as' => 'product.detail',
    'uses' => 'Frontend\ProductController@getDetail'
]);

Route::post('product/comment', [
    'as' => 'product.comment',
    'uses' => 'Frontend\ProductController@comment'
]);

Route::get('sidebar/filter-price', [
    'as' => 'sidebar.filterPrice',
    'uses' => 'Frontend\SidebarController@filterPrice'
]);

Route::get('search', [
    'as' => 'search',
    'uses' => 'Frontend\HomeController@search'
]);
Route::get('contact', [
    'as' => 'contact.get',
    'uses' => 'Frontend\ContactController@getContact'
]);
Route::post('contact', [
    'as' => 'contact.post',
    'uses' => 'Frontend\ContactController@postContact'
]);

