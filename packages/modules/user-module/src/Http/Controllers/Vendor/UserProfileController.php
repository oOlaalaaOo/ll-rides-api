<?php

namespace Modules\UserModule\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService as HttpResponse;

use Modules\UserModule\Http\Requests\Vendor\ProfileUpdateRequest;
use Modules\UserModule\Http\Requests\Vendor\ProfileAvatarUpdateRequest;
use Modules\UserModule\Http\Requests\Vendor\ProfileMainImgUpdateRequest;
use Modules\UserModule\Services\Vendor\UserService;
use Modules\UserModule\Services\Vendor\UserDetailService;
use Modules\UserModule\Services\Vendor\UserImageService;
use Modules\UserModule\Http\Resources\Vendor\UserResource;
use Modules\UserModule\Http\Resources\Vendor\UserImageResource;
use Modules\UserModule\Models\UserDetail;
use App\User;
use Auth;
use Storage;

class UserProfileController extends Controller
{
    public function updateUserDetails(
        ProfileUpdateRequest $request,
        UserService $userService,
        UserDetailService $userDetailService
    )
    {
        try {
            $auth_user = Auth::user();

            $user = $userService->update(
                [
                    'name'    => $request->input('name'),
                ],
                $auth_user->id
            );

            $userDetailService->update(
                [
                    'description'   => $request->input('description'),
                    'address1'      => $request->input('address1'),
                    'address2'      => $request->input('address2'),
                    'zipcode'       => $request->input('zipcode'),
                    'mobile_no'     => $request->input('mobile_no'),
                    'telephone_no'  => $request->input('telephone_no'),
                    'country'       => $request->input('country'),
                ],
                $auth_user->id
            );

            return HttpResponse::success([
                'user' => new UserResource($user)
            ]);
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function updateProfileAvatar(
        ProfileAvatarUpdateRequest $request,
        UserImageService $userImageService
    )
    {
        try {
            $auth_user = Auth::user();

            $path       = Storage::putFile('public/avatars', $request->file('avatar'));
            $url        = Storage::url($path);
            $size       = Storage::size($path);
            $extension  = $request->file('avatar')->extension();

            $has_avatar = $userImageService->hasAvatar($auth_user->id);

            $file_details = [
                'user_id'           => $auth_user->id,
                'file_name'         => $url,
                'file_mime'         => $extension,
                'file_size'         => $size,
                'file_dimension'    => '',
                'type'              => 'avatar',
            ];

            $user_image = null;

            if ($has_avatar) {
                $user_image = $userImageService->update($file_details, $auth_user->id);
            } else {
                $user_image = $userImageService->create($file_details);
            }

            return HttpResponse::success([
                'image' => new UserImageResource($user_image)
            ]);
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function updateProfileMainImg(
        ProfileMainImgUpdateRequest $request,
        UserImageService $userImageService
    )
    {
        try {
            $auth_user = Auth::user();

            $path       = Storage::putFile('public/main', $request->file('main'));
            $url        = Storage::url($path);
            $size       = Storage::size($path);
            $extension  = $request->file('main')->extension();

            $has_main = $userImageService->hasMainImg($auth_user->id);

            $file_details = [
                'user_id'           => $auth_user->id,
                'file_name'         => $url,
                'file_mime'         => $extension,
                'file_size'         => $size,
                'file_dimension'    => '',
                'type'              => 'main',
            ];

            $user_image = null;

            if ($has_main) {
                $user_image = $userImageService->update($file_details, $auth_user->id);
            } else {
                $user_image = $userImageService->create($file_details);
            }

            return HttpResponse::success([
                'image' => new UserImageResource($user_image)
            ]);
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }
}
