<?php


namespace App\Http\Controllers\API\Driver;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Auth\UserRegisterRequest;
use App\Http\Requests\API\Auth\LoginUserRequest;
use Validator;
use App\Exceptions\AppNotFoundException;
use App\Repositories\API\DriverUser\DriverUserRepository;
use App\Http\Helpers\DriverControllerHelper;

class AuthController extends BaseController
{
    public $driver;
    /**
     * AuthController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(DriverUserRepository $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request, DriverControllerHelper $authHelper) { 
        $code = $authHelper->findOrCreate($request->all());
        return $this->respondCreated($code);
    }
         
          
    public function login(LoginUserRequest $request, DriverControllerHelper $authHelper){ 
        $credentials = $request->only('email', 'password');
        $token = $authHelper->checkAuth($credentials);
        return $this->successResponse(['token' => $token]);            
    }
         
}