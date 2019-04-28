<?php

namespace App\Http\Helpers;

use DB;
use Event;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use App\Repositories\API\DriverUser\DriverUserRepository;
use App\Exceptions\AppUnauthorizedException;

class DriverControllerHelper
{
    public $driver;
    public $status;
    /**
     * @param \Driver $driver
     */
    public function __construct(DriverUserRepository $driver, HasherContract $hasher)
    {
        $this->driver = $driver;
    }

    public function findOrCreate($data)
    {
        if ($this->Driverd>isExists($data['role'], 'uEmail',$data['email']) == 0) {
            return $this->createUser($data);
        }

        throw new AppUnauthorizedException('1019');
    }

    public function createUser($data)
    {
        $formatUserData = $this->formatUser($data);
        DB::transaction(function () use ($formatUserData) {
            $user = $this->driver->create($formatUserData);
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
        if ($user = $this->driver->authenticate($credentials)) {
            return $user->createToken('AppName')-> accessToken;
        } 
        
        throw new AppUnauthorizedException(1023);
    }
}