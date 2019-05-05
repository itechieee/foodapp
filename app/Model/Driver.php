<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;

    protected $table = 'raider_details';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'radSSN', 'radLicenceNumber','radVechileNumber','radBankName', 'radAcNumber' ,'radRoutingNumber','radStatus','raddAddress1','raddAddress2', 'raddCity','raddState','raddZipCode','created_at', 'updated_at'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'uId') ;
    }
}
