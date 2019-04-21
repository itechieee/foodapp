<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class BaseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Base Controller 
    |--------------------------------------------------------------------------
    |
    | This controller function is accessible by both Admin and Restaurant controllers
    |
    */
    
    public function logout(Request $request) {

        Auth::logout();
        \Session::flush();
        return redirect('/');
      }
}
