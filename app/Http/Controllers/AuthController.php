<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('ll_rides_api')->accessToken;

            return response()->json([
                'status' => 'success',
                'accessToken' => $token,
                'user' => $user
            ], 200);
        }

        return response()->json([
            'status' => 'fail',
            'error' => 'Wrong credentials.'
        ], 403);
    }

    public function register(UserRequest $request)
    {
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'data' => $user
            ], 200);
        }

        return response()->json([
            'status' => 'fail'
        ]);
    }
}
