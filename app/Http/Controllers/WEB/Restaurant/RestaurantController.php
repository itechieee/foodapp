<?php

namespace App\Http\Controllers\WEB\Restaurant;

use App\Http\Controllers\WEB\BaseController;
use Auth;

class RestaurantController extends BaseController
{   
    /*
    |--------------------------------------------------------------------------
    | Restaurant Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles restaurant related process for the application 
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
    }

    /**
     * Handle an Restaurant dashboard
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function index()
    {
        return view('restaurant.index');
    }

}
