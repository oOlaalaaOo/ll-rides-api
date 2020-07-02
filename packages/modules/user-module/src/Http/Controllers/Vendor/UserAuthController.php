<?php

namespace Modules\UserModule\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService as HttpResponse;
use Modules\UserModule\Services\Vendor\UserService;
use Modules\UserModule\Http\Resources\Vendor\UserResource;

use Auth;

class UserAuthController extends Controller
{
    public function me(UserService $userService)
    {
        try {
            $auth_user = Auth::user();

            $user = $userService->getOne([
                'id' => $auth_user->id
            ]);

            return HttpResponse::success([
                'user' => new UserResource($user)
            ]);
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }
}
