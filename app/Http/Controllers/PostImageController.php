<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostImageResource;
use App\PostImage;

class PostImageController extends Controller
{
    public function index(Request $request)
    {
    	$postImages = PostImage::paginate(10);

    	return PostImageResource::collection($postImages);
    }

    public function show(Request $request, $id)
    {
    	$postImage = PostImage::findOrFail($id);

    	return new PostImageResource($postImage);
    }

    public function store(Request $request)
    {
    	$postImage = new PostImage;

    	$postImage->post_id = $request->input('post_id');
    	$postImage->title = $request->input('title');
    	$postImage->description = $request->input('description');
    	$postImage->file_name = $request->input('file_name');
    	$postImage->file_extension = $request->input('file_extension');
    	$postImage->file_size = $request->input('file_size');
    	$postImage->file_dimension = $request->input('file_dimension');

    	$postImage->save();

    	return new PostImageResource($postImage);
    }

    public function update(Request $request, $id)
    {
    	$postImage = PostImage::findOrFail($id);

    	$postImage->title = $request->input('title');
    	$postImage->description = $request->input('description');
    	$postImage->file_name = $request->input('file_name');
    	$postImage->file_extension = $request->input('file_extension');
    	$postImage->file_size = $request->input('file_size');
    	$postImage->file_dimension = $request->input('file_dimension');

    	$postImage->save();

    	return new PostImageResource($postImage);
    }

    public function destroy(Request $request)
    {
    	$postImage = PostImage::where('id', $id)->delete();

    	return new PostImageResource($postImage);
    }
}
