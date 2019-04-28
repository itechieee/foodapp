<?php


namespace App\Http\Controllers\API\Restaurant;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Auth\UserRegisterRequest;
use App\Http\Requests\API\Auth\LoginUserRequest;
use Validator;
use App\Exceptions\AppNotFoundException;
use App\Repositories\API\RestaurantUser\RestaurantUserRepository;
use App\Http\Transformers\API\RestaurantTransformer;
use Auth;

class RestaurantController extends BaseController
{
    public $restaurant;
    /**
     * RestaurantController constructor.
     *
     * @param PostRepositoryInterface $post
     */
    public function __construct(RestaurantUserRepository $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function restaurant_details(RestaurantTransformer $restaurantTransformer) {
        $restaurant = $restaurantTransformer->transformRestaurant(Auth::user());
        return $this->successResponse($restaurant);    
    }
}