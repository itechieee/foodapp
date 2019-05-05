<?php

namespace App\Http\Transformers\API;

class CustomerTransformer extends Transformer
{
    public function transform($item, $key)
    {
        // $item->setVisible(['uId']);
        return $item;
    }

    public function transformCustomer($item)
    {   
        $result = [];
        if($item->count() > 0) {
            $result['id'] = $item->uId;
            $result['firstname'] = $item->uFirstName;
            $result['middlename'] = $item->uMiddleName;
            $result['lastname'] = $item->uLastName;
            $result['email'] = $item->uEmail;
            $result['phone'] = $item->uPhone;
        }
        return $result;
    }
}