<?php

namespace App\Services\Vendor;

use App\User;
use Auth;
use Hash;

class UserService
{
    public function __construct()
    {
    }

    public function createUser($params = [])
    {
        $vendorRoleName = env('VENDOR_ROLE_NAME');

        $user = new User;

        $user->name         = $params['name'];
        $user->email        = $params['email'];
        $user->password     = Hash::make($params['password']);
        $user->role_name    = $vendorRoleName;

        $user->save();

        return $user;
    }

    public function loginUser($credentials = [])
    {
        if (!isset($credentials['email'])) {
            throw new Exception("email is not specified", 1);
        }

        if (!isset($credentials['password'])) {
            throw new Exception("password is not specified", 1);
        }

        $vendorRoleName = env('VENDOR_ROLE_NAME');

        if (Auth::attempt([
                'email'     => $credentials['email'],
                'password'  => $credentials['password'],
                'role_name' => $vendorRoleName
            ])) {
            return $this->_createUserToken($vendorRoleName);
        }

        return null;
    }

    private function _createUserToken($role)
    {
        $user = Auth::user();
        $token = $user->createToken('ll_rides_api', ['role-' . $role])->accessToken;

        return [
            'user'          => $user,
            'accessToken'   => $token
        ];
    }
}
