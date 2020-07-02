<?php

namespace Modules\UserModule\Services\Vendor;

use Modules\UserModule\Models\UserDetail;
use Auth;

class UserDetailService
{
    public function __construct()
    {
    }

    public function create($params = [])
    {
        if (!isset($params['user_id'])) {
            throw new Exception('user_id is not specified', 1);
        }

        if (isset($params['sex'])) {
            if (in_array($params['sex'], ['male', 'female'])) {
                throw new Exception('sex is not specified correctly', 1);
            }
        }

        $user_detail = new UserDetail;

        $user_detail->user_id        = $params['user_id'];
        $user_detail->description    = isset($params['description']) ? $params['description'] : null;
        $user_detail->address1       = isset($params['address1']) ? $params['address1'] : null;
        $user_detail->address2       = isset($params['address2']) ? $params['address2'] : null;
        $user_detail->state          = isset($params['state']) ? $params['state'] : null;
        $user_detail->city           = isset($params['city']) ? $params['city'] : null;
        $user_detail->country        = isset($params['country']) ? $params['country'] : null;
        $user_detail->zipcode        = isset($params['zipcode']) ? $params['zipcode'] : null;
        $user_detail->mobile_no      = isset($params['mobile_no']) ? $params['mobile_no'] : null;
        $user_detail->telephone_no   = isset($params['telephone_no']) ? $params['telephone_no'] : null;
        $user_detail->birthdate      = isset($params['birthdate']) ? $params['birthdate'] : null;
        $user_detail->sex            = isset($params['sex']) ? $params['sex'] : null;

        if (!$user_detail->save()) {
            throw new Exception('error saving user-detail', 1);
        }

        \Log::info('user-detail:created' . json_encode($user_detail));
        
        return $user_detail;
    }

    public function update($params = [], $user_id)
    {
        $user_detail = UserDetail::where('user_id', $user_id)->first();

        if (isset($params['description'])) {
            $user_detail->description = $params['description'];
        }
        
        if (isset($params['address1'])) {
            $user_detail->address1 = $params['address1'];
        }

        if (isset($params['address2'])) {
            $user_detail->address2 = $params['address2'];
        }

        if (isset($params['state'])) {
            $user_detail->state = $params['state'];
        }

        if (isset($params['city'])) {
            $user_detail->city = $params['city'];
        }

        if (isset($params['country'])) {
            $user_detail->country = $params['country'];
        }

        if (isset($params['zipcode'])) {
            $user_detail->zipcode = $params['zipcode'];
        }

        if (isset($params['mobile_no'])) {
            $user_detail->mobile_no = $params['mobile_no'];
        }

        if (isset($params['telephone_no'])) {
            $user_detail->telephone_no = $params['telephone_no'];
        }

        if (isset($params['birthdate'])) {
            $user_detail->birthdate = $params['birthdate'];
        }

        if (isset($params['sex'])) {
            $user_detail->sex = $params['sex'];
        }

        if (!$user_detail->save()) {
            throw new Exception('error saving user-detail', 1);
        }

        \Log::info('user-detail:updated' . json_encode($user_detail));
        
        return $user_detail;
    }
}
