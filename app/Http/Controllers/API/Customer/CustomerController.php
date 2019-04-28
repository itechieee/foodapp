<?php


namespace App\Http\Controllers\API\Customer;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Auth\UserRegisterRequest;
use App\Http\Requests\API\Auth\LoginUserRequest;
use Validator;
use App\Exceptions\AppNotFoundException;
use App\Repositories\API\CustomerUser\CustomerUserRepository;
use App\Http\Transformers\API\CustomerTransformer;
use Auth;

class CustomerController extends BaseController
{
    public $customerUser;
    /**
     * CustomerController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(CustomerUserRepository $customerUser)
    {
        $this->customerUser = $customerUser;
    }

    public function customer_details(CustomerTransformer $customerTransformer) {
        $customer = $customerTransformer->transformCustomer(Auth::user());
        return $this->successResponse($customer);    
    }
}