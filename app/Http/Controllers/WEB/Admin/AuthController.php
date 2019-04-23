<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\WEB\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\WEB\Auth\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends BaseController
{   
    /*
    |--------------------------------------------------------------------------
    | Auth Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); 
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $input = $request->only('email', 'password');
        $check = Auth::attempt(['uEmail' => $input['email'],'password' => $input['password'], 'role_id' => 1]);
        if($check){
            /** Authentication Success */
            $user = Auth::user();
            return redirect()->route('web.admin.dashboard');
        }else{
            /** Authentication Failed */
            return redirect()->back()->withErrors('Invalid Email/Password');
        }
    }

}
