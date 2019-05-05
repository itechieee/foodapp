<?php

namespace App\Http\Transformers\API;

class RestaurantTransformer extends Transformer
{
    public function transform($item, $key)
    {
        // $item->setVisible(['uId']);
        return $item;
    }

    public function transformRestaurant($item)
    {   
        $result = [];
        if($item->count() > 0) {
            $result['id'] = $item->restId;
            $result['name'] = $item->restName;
            $result['address1'] = $item->restAddress1;
            $result['address2'] = $item->restAddress2;
            $result['city'] = $item->restCity;
            $result['zipCode'] = $item->restZipCode;
            $result['latitude'] = $item->restLat;
            $result['longitude'] = $item->restLng;
            $result['preparationTime'] = $item->restPreparationTime;
            $result['packingCharge'] = $item->restPackingCharge;
            $result['adminCommission'] = $item->restAdminComission;
            $result['minOrderAmount'] = $item->restMinOrderAmount;
            $result['mode'] = $item->restMode;
            $result['status'] = $item->restStatus;
            $result['createdAt'] = $item->created_at;
            $result['updatedAt'] = $item->updated_at;
        }
        return $result;
    }
}
