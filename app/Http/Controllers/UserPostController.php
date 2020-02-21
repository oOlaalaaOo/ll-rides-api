<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserPostResource;
use App\Http\Requests\UserPostStoreRequest;
use App\Http\Requests\UserPostUpdateRequest;
use App\UserPost;
use Auth;

class UserPostController extends Controller
{
    public function getUserPosts()
    {
        try {
            $user = Auth::user();


            $userPosts = UserPost::with([
                                        'user',
                                        'tags',
                                        'images'
                                    ])
                                    ->where('user_id', $user->id)
                                    ->get();

            return response()->json([
                'status'    => 'success',
                'data'      => UserPostResource::collection($userPosts)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'fail',
                'error'     => $e->getMessage()
            ]);
        }
    }

    public function getUserPost()
    {
        try {
            $user = Auth::user();


            $userPost = UserPost::with([
                                        'user',
                                        'tags',
                                        'images'
                                    ])
                                    ->where('user_id', $user->id)
                                    ->first();

            return response()->json([
                'status'    => 'success',
                'data'      => new UserPostResource($userPost)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'fail',
                'error'     => $e->getMessage()
            ]);
        }
    }

    public function storeUserPost(UserPostStoreRequest $request)
    {
        try {
            $user = Auth::user();


            $title = $request->input('title');
            $description = $request->input('description');


            $userPost = new UserPost;

            $userPost->user_id      = $userId;
            $userPost->title        = $title;
            $userPost->description  = $description;

            $userPost->save();

            return response()->json([
                'status'    => 'success',
                'data'      => $userPost
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'fail',
                'error'     => $e->getMessage()
            ]);
        }
    }

    public function updateUserPost(UserPostUpdateRequest $request, $id)
    {
        try {
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

                return response()->json([
                    'status'    => 'success',
                    'data'      => $userPost
                ], 200);
            }

            return response()->json([
                'status'    => 'fail',
                'error'     => 'Post not found for user'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'fail',
                'error'     => $e->getMessage()
            ]);
        }
    }

    public function destroyUserPost($id)
    {
        try {
            $user = Auth::user();


            $userPost = UserPost::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->delete();

            if ($userPost) {
                return response()->json([
                    'status'    => 'success',
                    'data'      => new UserPostResource($userPost)
                ], 200);
            }

            return response()->json([
                'status'    => 'fail',
                'error'     => 'Post not found for user'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'fail',
                'error'     => $e->getMessage()
            ]);
        }
    }
}
