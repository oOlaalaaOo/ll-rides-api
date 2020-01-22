<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostTagResource;
use App\PostTag;

class PostTagController extends Controller
{
    public function index(Request $request)
    {
    	$postTags = PostTag::paginate(10);

    	return PostTagResource::collection($postTags);
    }

    public function show(Request $request, $id)
    {
    	$postTag = PostTag::findOrFail($id);

    	return new PostTagResource($postTag);
    }

    public function store(Request $request)
    {
    	$postTag = new PostTag;

    	$postTag->post_id = $request->input('post_id');
    	$postTag->name = $request->input('name');

    	$postTag->save();

    	return new PostTagResource($postTag);
    }

    public function update(Request $request, $id)
    {
    	$postTag = PostTag::findOrFail($id);

    	$postTag->name = $request->input('name');

    	$postTag->save();

    	return new PostTagResource($postTag);
    }

    public function destroy(Request $request)
    {
    	$postTag = PostTag::where('id', $id)->delete();

    	return new PostTagResource($postTag);
    }
}
