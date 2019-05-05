<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;

    protected $table = 'restaurant';
    protected $primaryKey = 'restId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'restId', 'userId', 'restName','restAddress1','restAddress2', 'restCity' ,'restZipCode','restLat','restLng','restPreparationTime', 'restPackingCharge','restAdminComission','restMinOrderAmount','restMode', 'restStatus','created_at', 'updated_at'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'uId') ;
    }
}
