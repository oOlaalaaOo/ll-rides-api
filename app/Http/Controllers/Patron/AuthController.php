<?php

namespace App\Http\Controllers\Patron;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use App\Http\Requests\Patron\UserRequest;
use App\Http\Requests\Patron\LoginRequest;
use Auth;
use App\Services\HttpResponseHandlerService;

class AuthController extends Controller
{
    private $httpResponseHandlerService;

    public function __construct()
    {
        $this->httpResponseHandlerService = new HttpResponseHandlerService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('ll_rides_api')->accessToken;

                return $this->httpResponseHandlerService->handleSuccess([
                    'accessToken'   => $token,
                    'user'          => $user
                ]);
            }

            return $this->httpResponseHandlerService->handleError('The email address and password did not matched.', 403);
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function register(UserRequest $request)
    {
        try {
            $user = new User;

            $user->name         = $request->input('name');
            $user->email        = $request->input('email');
            $user->password     = Hash::make($request->input('password'));

            $user->save();

            return $this->httpResponseHandlerService->handleSuccess([
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function me(Request $request)
    {
        try {
            return $this->httpResponseHandlerService->handleSuccess([
                'user' => Auth::user()
            ]);
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }
}
