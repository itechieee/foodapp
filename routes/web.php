<?php

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
// });


Route::get('/', ['uses' => 'WEB\HomeController@index', 'as' => 'login']);
Route::get('admin/login', ['uses' => 'WEB\Admin\AuthController@login', 'as' => 'web.admin.login']);
Route::get('restaurant/login', ['uses' => 'WEB\Restaurant\AuthController@login', 'as' => 'web.restaurant.login']);

Route::post('admin/login', ['uses' => 'WEB\Admin\AuthController@authenticate', 'as' => 'web.admin.post_login']);
Route::post('restaurant/login', ['uses' => 'WEB\Restaurant\AuthController@authenticate', 'as' => 'web.admin.post_login']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('auth/logout', ['uses' => 'WEB\BaseController@logout', 'as' => 'logout']);

    // Admin Routes 
    Route::group(['prefix' => 'admin', 'middleware' => ['role']], function () {
        Route::get('/', ['uses' => 'WEB\Admin\AdminController@index', 'as' => 'web.admin.dashboard']);
    });

    
    // Restaurant Routes
    Route::group(['prefix' => 'restaurant', 'middleware' => ['role']], function () {
        Route::get('/', ['uses' => 'WEB\Restaurant\RestaurantController@index', 'as' => 'web.restaurant.dashboard']);
    });

});