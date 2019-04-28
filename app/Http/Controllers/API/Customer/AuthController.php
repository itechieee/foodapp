<?php


namespace App\Http\Controllers\API\Customer;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Auth\UserRegisterRequest;
use App\Http\Requests\API\Auth\LoginUserRequest;
use Validator;
use App\Exceptions\AppNotFoundException;
use App\Repositories\API\CustomerUser\CustomerUserRepository;
use App\Http\Helpers\CustomerControllerHelper;

class AuthController extends BaseController
{
    public $customer;
    /**
     * AuthController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(CustomerUserRepository $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request, CustomerControllerHelper $authHelper) { 
        $code = $authHelper->findOrCreate($request->all());
        return $this->respondCreated($code);
    }
         
          
    public function login(LoginUserRequest $request, CustomerControllerHelper $authHelper){ 
        $credentials = $request->only('email', 'password');
        $token = $authHelper->checkAuth($credentials);
        return $this->successResponse(['token' => $token]);            
    }
         
}