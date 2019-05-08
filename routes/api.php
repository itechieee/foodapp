<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Restaurant 
Route::prefix('restaurant/v1')->group(function(){
    Route::post('login', 'API\Restaurant\AuthController@login');
    // Route::post('register', 'API\Restaurant\AuthController@register');


    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('restaurantdetails', 'API\Restaurant\RestaurantController@restaurant_details');
    });
    
});

// Customer 
Route::prefix('customer/v1')->group(function(){
    Route::post('login', 'API\Customer\AuthController@login');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('customerdetails', 'API\Customer\CustomerController@customer_details');
    });
    
});

// Driver 
Route::prefix('driver/v1')->group(function(){
    Route::post('login', 'API\Driver\AuthController@login');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('driverdetails', 'API\Driver\DriverController@driver_details');
    });
    
});
