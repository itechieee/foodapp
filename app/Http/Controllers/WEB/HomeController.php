<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\WEB\BaseController;

class HomeController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller 
    |--------------------------------------------------------------------------
    |
    | This controller for index home page
    |
    */
    
    public function index() {
        return view('home.index');
    }
}
