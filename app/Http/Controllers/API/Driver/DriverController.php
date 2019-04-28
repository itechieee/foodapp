<?php


namespace App\Http\Controllers\API\Driver;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Auth\UserRegisterRequest;
use App\Http\Requests\API\Auth\LoginUserRequest;
use Validator;
use App\Exceptions\AppNotFoundException;
use App\Repositories\API\DriverUser\DriverUserRepository;
use App\Http\Transformers\API\DriverTransformer;
use Auth;

class DriverController extends BaseController
{
    public $driverUser;
    /**
     * DriverController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(DriverUserRepository $driverUser)
    {
        $this->driverUser = $driverUser;
    }

    public function driver_details(DriverTransformer $driverTransformer) {
        $driver = $driverTransformer->transformDriver(Auth::user());
        return $this->successResponse($driver);    
    }
}