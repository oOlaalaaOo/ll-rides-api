<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserPostResource;
use App\Http\Requests\UserPostStoreRequest;
use App\Http\Requests\UserPostUpdateRequest;
use App\Post;
use Auth;
use App\Services\HttpResponseHandlerService;

class PostController extends Controller
{
    private $httpResponseHandlerService;

    public function __construct()
    {
        $this->httpResponseHandlerService = new HttpResponseHandlerService;
    }

    public function getPosts()
    {
        try {
            $user = Auth::user();

            $posts = Post::with([
                                    'user',
                                    'tags',
                                    'images'
                                ])
                                ->where('user_id', $user->id)
                                ->get();

            return $this->httpResponseHandlerService->handleSuccess(UserPostResource::collection($posts));
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function getPost()
    {
        try {
            $user = Auth::user();

            $post = Post::with([
                                'user',
                                'tags',
                                'images'
                            ])
                            ->where('user_id', $user->id)
                            ->first();

            return $this->httpResponseHandlerService->handleSuccess(new PostResource($post));
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function createPost(PostStoreRequest $request)
    {
        try {
            $user = Auth::user();

            $post = new Post;

            $post->user_id      = $userId;
            $post->title        = $request->input('title');
            $post->description  = $request->input('description');

            $post->save();

            return $this->httpResponseHandlerService->handleSuccess(new PostResource($post));
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function updatePost(PostUpdateRequest $request, $id)
    {
        try {
            $user = Auth::user();

            $post = Post::where('id', $id)
                            ->where('user_id', $user->id)
                            ->first();

            if (!$post) {
                return $this->httpResponseHandlerService->handleError('No post found', '404');
            }

            $post->title        = $request->input('title');
            $post->description  = $request->input('description');

            $post->save();

            return response()->json([
                'status'    => 'success',
                'data'      => $post
            ], 200);

            return $this->httpResponseHandlerService->handleSuccess(new PostResource($post));
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function deletePost($id)
    {
        try {
            $user = Auth::user();

            $post = Post::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->delete();

            if (!$post) {
                return $this->httpResponseHandlerService->handleError('Post not found for user', 404);
            }

            return $this->httpResponseHandlerService->handleSuccess(new PostResource($post));
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }
}
