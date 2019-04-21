<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\WEB\BaseController;
use Auth;

class AdminController extends BaseController
{   
    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles admin related process for the application 
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
     * Handle an Admin dashboard
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.index');
    }

}
