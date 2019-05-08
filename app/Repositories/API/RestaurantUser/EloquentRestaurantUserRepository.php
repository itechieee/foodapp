<?php

namespace App\Repositories\API\RestaurantUser;

use App\Repositories\EloquentAbstractRepository;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use App\Exceptions\AppUnauthorizedException;
use Auth;

class EloquentRestaurantUserRepository extends EloquentAbstractRepository implements RestaurantUserRepository
{
    public $hasher;

    public function __construct(HasherContract $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * [getModel description].
     *
     * @return [type] [description]
     */
    public function getModel()
    {
        $model = 'App\Model\User';

        return new $model();
    }

    public function getCount($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->count();
    }
    public function isExists($role, $key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->where('role_id',$role)->count();
    }

    public function authenticate($credentials)
    {
        if ($user = $this->findBy('uEmail', '=', $credentials['email'])->first()) {
            if ($this->hasher->check($credentials['password'], $user->uPassword) && $user->role_id == env('RESTAURANT_ROLE')) {
                return $user;
            }
        }

        return false;
    }

    public function restaurant($userId)
    {
        return $this->getModel()->find($userId)->restaurant()->first();
    }


    public function getRestaurantByUser($data)
    {
        if(Auth::user()->uId != $data['user_id']) {
            throw new AppUnauthorizedException(1029);
        }

        $restaurant = $this->restaurant(Auth::user()->uId);

        if($restaurant->restId != $data['restaurant_id']) {
            throw new AppUnauthorizedException(1029);
        }
        
        return $restaurant;
    }
}
