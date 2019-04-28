<?php


namespace App\Http\Controllers\API\Restaurant;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Auth\UserRegisterRequest;
use App\Http\Requests\API\Auth\LoginUserRequest;
// use App\Model\User;
use Validator;
use App\Exceptions\AppNotFoundException;
use App\Repositories\API\RestaurantUser\RestaurantUserRepository;
use App\Http\Helpers\RestaurantControllerHelper;

class AuthController extends BaseController
{
    public $restaurant;
    /**
     * AuthController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(RestaurantUserRepository $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request, RestaurantControllerHelper $authHelper) { 
        $code = $authHelper->findOrCreate($request->all());
        return $this->respondCreated($code);
    }
         
          
    public function login(LoginUserRequest $request, RestaurantControllerHelper $authHelper){ 
        $credentials = $request->only('email', 'password');
        $token = $authHelper->checkAuth($credentials);
        return $this->successResponse(['token' => $token]);            
    }
         
}