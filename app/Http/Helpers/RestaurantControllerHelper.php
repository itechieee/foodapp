<?php

namespace App\Http\Helpers;

use DB;
use Event;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use App\Repositories\API\RestaurantUser\RestaurantUserRepository;
use App\Exceptions\AppUnauthorizedException;

class RestaurantControllerHelper
{
    public $restaurant;
    public $status;
    /**
     * @param \Restaurant $restaurant
     */
    public function __construct(RestaurantUserRepository $restaurant, HasherContract $hasher)
    {
        $this->restaurant = $restaurant;
    }

    public function findOrCreate($data)
    {
        if ($this->restaurant->isExists($data['role'], 'uEmail',$data['email']) == 0) {
            return $this->createUser($data);
        }

        throw new AppUnauthorizedException('1019');
    }

    public function createUser($data)
    {
        $formatUserData = $this->formatUser($data);
        DB::transaction(function () use ($formatUserData) {
            $user = $this->user->create($formatUserData);
        });
        return 1020;
    }

    public function formatUser($data)
    {
        $user['uFirstName'] = $data['firstname'];
        $user['uMiddleName'] = $data['lastname'];
        $user['uLastName'] = $data['middlename'];
        $user['uEmail'] = $data['email'];
        $user['uPassword'] = Hash::make($data['password']);
        $user['role_id'] = $data['role'];
        $user['uPhone'] = $data['phone'];
        return $user;
    }

    public function checkAuth($credentials)
    {
        if ($user = $this->restaurant->authenticate($credentials)) {
            return $user->createToken('AppName')-> accessToken;
        } 
        
        throw new AppUnauthorizedException(1023);
    }
}