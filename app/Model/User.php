<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes, Notifiable;    

    protected $table = 'users';
    protected $primaryKey = 'uId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uFirstName', 'uMiddleName', 'uLastName','uEmail','uPhone', 'role_id' ,'uEmailVerifiedAt','uPassword','uRememberToken','uCreatedAt', 'uUpdatedAt','uDeletedAt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uPassword', 'uRememberToken',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uEmailVerifiedAt' => 'datetime',
    ];

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'uCreatedAt';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'uUpdatedAt';

    protected $dates = ['uDeletedAt'];
    const DELETED_AT = 'uDeletedAt';

    public function getAuthPassword()
    {
        return $this->uPassword;
    }

}
