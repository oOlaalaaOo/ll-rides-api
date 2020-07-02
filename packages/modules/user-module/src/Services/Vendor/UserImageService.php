<?php

namespace Modules\UserModule\Services\Vendor;

use Modules\UserModule\Models\UserImage;
use Auth;

class UserImageService
{
    public function __construct()
    {
    }

    public function create($params = [])
    {
        if (!isset($params['user_id'])) {
            throw new Exception('user_id is not specified', 1);
        }

        $user_detail = new UserImage;

        $user_detail->user_id           = $params['user_id'];
        $user_detail->file_name         = isset($params['file_name']) ? $params['file_name'] : null;
        $user_detail->file_mime         = isset($params['file_mime']) ? $params['file_mime'] : null;
        $user_detail->file_size         = isset($params['file_size']) ? $params['file_size'] : null;
        $user_detail->file_dimension    = isset($params['file_dimension']) ? $params['file_dimension'] : null;
        $user_detail->type              = isset($params['type']) ? $params['type'] : null;

        if (!$user_detail->save()) {
            throw new Exception('error saving user-image', 1);
        }

        \Log::info('user-image:created' . json_encode($user_detail));
        
        return $user_detail;
    }

    public function update($params = [], $user_id)
    {
        if (!isset($params['type'])) {
            throw new Exception('type is not specified', 1);  
        }

        $user_image = UserImage::where('user_id', $user_id)->where('type', $params['type'])->first();

        if (isset($params['file_name'])) {
            $user_image->file_name = $params['file_name'];
        }
        
        if (isset($params['file_mime'])) {
            $user_image->file_mime = $params['file_mime'];
        }

        if (isset($params['file_size'])) {
            $user_image->file_size = $params['file_size'];
        }

        if (isset($params['file_dimension'])) {
            $user_image->file_dimension = $params['file_dimension'];
        }

        if (!$user_image->save()) {
            throw new Exception('error saving user-image', 1);
        }

        \Log::info('user-image:updated' . json_encode($user_image));
        
        return $user_image;
    }

    public function hasAvatar($user_id)
    {
        $avatar_count = UserImage::where('user_id', $user_id)
                                ->where('type', 'avatar')
                                ->count();

        return $avatar_count > 0 ? true : false;
    }

    public function hasMainImg($user_id)
    {
        $main_img_count = UserImage::where('user_id', $user_id)
                                ->where('type', 'main')
                                ->count();

        return $main_img_count > 0 ? true : false;
    }
}
