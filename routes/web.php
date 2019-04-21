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


Route::get('/', ['uses' => 'WEB\AuthController@login', 'as' => 'login']);
Route::post('/login', ['uses' => 'WEB\AuthController@authenticate', 'as' => 'web.post.login']);

// Route::get('/', ['uses' => 'WEB\HomeController@index', 'as' => 'login']); // Common Home Page




Route::group(['middleware' => ['auth']], function () {


    // Route::get('/', function () {
    //         return view('welcome');
    //     });


    Route::get('auth/logout', ['uses' => 'WEB\BaseController@logout', 'as' => 'logout']);
    
    // Admin Routes 
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', ['uses' => 'WEB\Admin\AdminController@index', 'as' => 'web.admin.dashboard']);
    });

    // Restaurant Routes
    Route::group(['prefix' => 'restaurant'], function () {
        Route::get('/', ['uses' => 'WEB\Restaurant\RestaurantController@index', 'as' => 'web.restaurant.dashboard']);
    });
});