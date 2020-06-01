<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserImageResource;
use App\UserImage;

class UserImageController extends Controller
{
    public function index(Request $request)
    {
        $userImages = UserImage::paginate(10);

        return UserImageResource::collection($userImages);
    }

    public function show(Request $request, $id)
    {
        $userImage = UserImage::findOrFail($id);

        return new UserImageResource($userImage);
    }

    public function store(Request $request)
    {
        $userImage = new UserImage;

        $userImage->post_id        = $request->input('post_id');
        $userImage->title          = $request->input('title');
        $userImage->description    = $request->input('description');
        $userImage->file_name      = $request->input('file_name');
        $userImage->file_mime 	   = $request->input('file_mime');
        $userImage->file_size      = $request->input('file_size');
        $userImage->file_dimension = $request->input('file_dimension');

        $userImage->save();

        return new UserImageResource($userImage);
    }

    public function update(Request $request, $id)
    {
        $userImage = UserImage::findOrFail($id);

        $userImage->title          = $request->input('title');
        $userImage->description    = $request->input('description');
        $userImage->file_name      = $request->input('file_name');
        $userImage->file_mime 	   = $request->input('file_mime');
        $userImage->file_size      = $request->input('file_size');
        $userImage->file_dimension = $request->input('file_dimension');

        $userImage->save();

        return new UserImageResource($userImage);
    }

    public function destroy(Request $request)
    {
        $userImage = UserImage::where('id', $id)->delete();

        return new UserImageResource($userImage);
    }
}
