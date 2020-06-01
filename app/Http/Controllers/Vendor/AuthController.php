<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\UserRequest;
use App\Http\Requests\Vendor\LoginRequest;
use App\Services\HttpResponseHandlerService;
use App\Services\Vendor\UserService;
use App\Services\Vendor\UserDetailService;
use App\Http\Resources\Vendor\UserResource;
use App\User;
use Auth;

class AuthController extends Controller
{
    private $httpResponseHandlerService;

    public function __construct()
    {
        $this->httpResponseHandlerService = new HttpResponseHandlerService;
    }

    public function login(LoginRequest $request, UserService $userService)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $vendorRoleName = env('VENDOR_ROLE_NAME');

            $authUser = $userService->loginUser($credentials);

            if (!$authUser) {
                return $this->httpResponseHandlerService->handleError('The email address and password did not matched.', 403);
            }

            return $this->httpResponseHandlerService->handleSuccess($authUser);
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function register(UserRequest $request, UserService $userService, UserDetailService $userDetailService)
    {
        $vendorRoleName = env('VENDOR_ROLE_NAME');

            $user = $userService->createUser($request->all());

            if (!$user) {
                return $this->httpResponseHandlerService->handleError('No user specified', 404);
            }
            
            $userDetailService->createUserDetail(['userId' => $user->id]);

            return $this->httpResponseHandlerService->handleSuccess([
                'user' => new UserResource($user)
            ]);
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
