<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserPostResource;
use App\Http\Requests\UserPostStoreRequest;
use App\Http\Requests\UserPostUpdateRequest;
use App\UserPost;

class UserPostController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();


        $userPosts = UserPost::where('user_id', $user->id)
                                ->paginate(10);

        return UserPostResource::collection($userPosts);
    }

    public function show($id)
    {
        $user = Auth::user();


        $userPost = UserPost::where('id', $id)
                                ->where('user_id', $user->id)
                                ->first();

        return new UserPostResource($userPost);
    }

    public function store(UserPostStoreRequest $request)
    {
        $user = Auth::user();


        $title = $request->input('title');
        $description = $request->input('description');


        $userPost = new UserPost;

        $userPost->user_id      = $user->id;
        $userPost->title        = $title;
        $userPost->description  = $description;

        $userPost->save();

        return new UserPostResource($userPost);
    }

    public function update(UserPostUpdateRequest $request, $id)
    {
        $user = Auth::user();


        $title          = $request->input('title');
        $description    = $request->input('description');


        $userPost = UserPost::where('id', $id)
                                ->where('user_id', $user->id)
                                ->first();

        if ($userPost) {
            $userPost->title        = $title;
            $userPost->description  = $description;

            $userPost->save();

            return new UserPostResource($userPost);
        }

        return response()->json([
            'status'    => 'fail',
            'error'     => 'Post not found for user'
        ], 500);
    }

    public function destroy($id)
    {
        $user = Auth::user();


        $userPost = UserPost::where('id', $id)
                                ->where('user_id', $user->id)
                                ->delete();

        if ($userPost) {
            return new UserPostResource($userPost);
        }

        return response()->json([
            'status'    => 'fail',
            'error'     => 'Post not found for user'
        ], 500);
    }
}
