<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserPostResource;
use App\UserPost;

class UserPostController extends Controller
{
    public function index(Request $request)
    {
    	$userPosts = UserPost::paginate(10);

    	return UserPostResource::collection($userPosts);
    }

    public function show(Request $request, $id)
    {
    	$userPost = UserPost::findOrFail($id);

    	return new UserPostResource($userPost);
    }

    public function store(Request $request)
    {
    	$userPost = new UserPost;

    	$userPost->user_id = $request->input('user_id');
    	$userPost->title = $request->input('title');
    	$userPost->description = $request->input('description');

    	$userPost->save();

    	return new UserPostResource($userPost);
    }

    public function update(Request $request, $id)
    {
    	$userPost = UserPost::findOrFail($id);

    	$userPost->title = $request->input('title');
    	$userPost->description = $request->input('description');

    	$userPost->save();

    	return new UserPostResource($userPost);
    }

    public function destroy(Request $request)
    {
    	$userPost = UserPost::where('id', $id)->delete();

    	return new UserPostResource($userPost);
    }
}
