<?php

namespace Modules\AuthModule\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService as HttpResponse;

use Modules\AuthModule\Http\Requests\Vendor\RegisterRequest;
use Modules\AuthModule\Http\Requests\Vendor\LoginRequest;
use Modules\AuthModule\Services\Vendor\AuthService;
use Modules\UserModule\Http\Resources\Vendor\UserResource;
use Modules\UserModule\Services\Vendor\UserDetailService;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request, AuthService $authService)
    {
        try {
            $credentials = $request->only(['email', 'password']);

            $authUser = $authService->loginUser($credentials);

            if (!$authUser) {
                return HttpResponse::error('The email address and password did not matched.', 403);
            }

            return HttpResponse::success($authUser);
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function register(RegisterRequest $request, AuthService $authService, UserDetailService $userDetailService)
    {
        try {
            $user = $authService->createUser($request->all());
            
            $userDetailService->create(['user_id' => $user->id]);

            return HttpResponse::success([
                'user' => new UserResource($user)
            ]);
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }
}
