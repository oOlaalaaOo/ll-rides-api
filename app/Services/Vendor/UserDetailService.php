<?php

namespace App\Services\Vendor;

use App\UserDetail;
use Auth;

class UserDetailService
{
    public function __construct()
    {
    }

    public function createUserDetail($params = [])
    {
        $userDetail = new UserDetail;

        $userDetail->user_id        = $params['userId'];
        $userDetail->description    = isset($params['description']) ? $params['description'] : null;
        $userDetail->address1       = isset($params['address1']) ? $params['address1'] : null;
        $userDetail->address2       = isset($params['address2']) ? $params['address2'] : null;
        $userDetail->state          = isset($params['state']) ? $params['state'] : null;
        $userDetail->city           = isset($params['city']) ? $params['city'] : null;
        $userDetail->country        = isset($params['country']) ? $params['country'] : null;
        $userDetail->zipcode        = isset($params['zipcode']) ? $params['zipcode'] : null;
        $userDetail->mobile_no      = isset($params['mobileNo']) ? $params['mobileNo'] : null;
        $userDetail->telephone_no   = isset($params['telephoneNo']) ? $params['telephoneNo'] : null;
        $userDetail->birthdate      = isset($params['birthdate']) ? $params['birthdate'] : null;
        $userDetail->sex            = isset($params['sex']) ? $params['sex'] : null;

        $userDetail->save();

        return $userDetail;
    }
}
