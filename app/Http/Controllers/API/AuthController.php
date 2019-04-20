<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Auth\UserRegisterRequest;
use App\Http\Requests\API\Auth\LoginUserRequest;
use App\Model\User;
use Validator;
use App\Exceptions\AppNotFoundException;
use App\Repositories\User\UserRepository;
use App\Http\Helpers\AuthControllerHelper;

class AuthController extends BaseController
{
    public $user;
    /**
     * AuthController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request, AuthControllerHelper $authHelper) { 
        $code = $authHelper->findOrCreate($request->all());
        return $this->respondCreated($code);
    }
         
          
    public function login(LoginUserRequest $request, AuthControllerHelper $authHelper){ 
        $credentials = $request->only('email', 'password');
        $token = $authHelper->checkAuth($credentials);
        return $this->successResponse(['token' => $token]);            
    }
         
    // public function getUser() {
    //     $user = Auth::user();
    //     return response()->json(['success' => $user], $this->successStatus); 
    // }


}