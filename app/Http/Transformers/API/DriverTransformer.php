<?php

namespace App\Http\Transformers\API;
use Auth;

class DriverTransformer extends Transformer
{
    public function transform($item, $key)
    {
        // $item->setVisible(['uId']);
        return $item;
    }

    public function transformDriver($item)
    {   
        $result = [];
        if($item->count() > 0) {
            $result['id'] = $item->id;
            $result['userId'] = $item->userId;
            $result['firstname'] = Auth::user()->uFirstName;
            $result['middlename'] = Auth::user()->uMiddleName;
            $result['lastname'] = Auth::user()->uLastName;
            $result['email'] = Auth::user()->uEmail;
            $result['phone'] = Auth::user()->uPhone;
            $result['ssn'] = $item->radSSN;
            $result['licenceNumber'] = $item->radLicenceNumber;
            $result['vechileNumber'] = $item->radVechileNumber;
            $result['bankName'] = $item->radBankName;
            $result['accNumber'] = $item->radAcNumber;
            $result['routingNumber'] = $item->radRoutingNumber;
            $result['status'] = $item->radStatus;
            $result['address1'] = $item->raddAddress1;
            $result['address2'] = $item->raddAddress2;
            $result['city'] = $item->raddCity;
            $result['state'] = $item->raddState;
            $result['zipCode'] = $item->raddZipCode;
            $result['createdAt'] = $item->created_at;
            $result['updatedAt'] = $item->updated_at;

        }
        return $result;
    }
}
