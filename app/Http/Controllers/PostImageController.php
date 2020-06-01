<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostImageResource;
use App\PostImage;

class PostImageController extends Controller
{
	private $httpResponseHandlerService;

    public function __construct()
    {
        $this->httpResponseHandlerService = new HttpResponseHandlerService;
    }

    public function getPostImages(Request $request, $postId)
    {
        try {
			$postImages = PostImage::where('post_id', $postId)->paginate(10);

			return $this->httpResponseHandlerService->handleSuccess(PostImageResource::collection($postImages));
		} catch (\Exception $e) {
			return $this->httpResponseHandlerService->handleError($e->getMessage());
		}
    }

    public function getPostImage(Request $request, $postId, $postImageId)
    {
        try {
			$postImage = PostImage::where('id', $postImageId)->where('post_id', $postId);

			return $this->httpResponseHandlerService->handleSuccess(new PostImageResource($postImage));
		} catch (\Exception $e) {
			return $this->httpResponseHandlerService->handleError($e->getMessage()); 
		}
    }

    public function createPostImage(Request $request)
    {
        try {
			$postImage = new PostImage;

			$postImage->post_id        = $request->input('post_id');
			$postImage->title          = $request->input('title');
			$postImage->description    = $request->input('description');
			$postImage->file_name      = $request->input('file_name');
			$postImage->file_extension = $request->input('file_extension');
			$postImage->file_size      = $request->input('file_size');
			$postImage->file_dimension = $request->input('file_dimension');

			$postImage->save();

			return $this->httpResponseHandlerService->handleSuccess(new PostImageResource($postImage));
		} catch (\Exception $e) {
			return $this->httpResponseHandlerService->handleError($e->getMessage()); 
		}
    }

    public function updatePostImage(Request $request, $id)
    {
        try {
			$postImage = PostImage::findOrFail($id);

			$postImage->title          = $request->input('title');
			$postImage->description    = $request->input('description');
			$postImage->file_name      = $request->input('file_name');
			$postImage->file_extension = $request->input('file_extension');
			$postImage->file_size      = $request->input('file_size');
			$postImage->file_dimension = $request->input('file_dimension');

			$postImage->save();

			return $this->httpResponseHandlerService->handleSuccess(new PostImageResource($postImage));
		} catch (\Exception $e) {
			return $this->httpResponseHandlerService->handleError($e->getMessage());
		}
    }

    public function deletePostImage(Request $request)
    {
        try {
			$postImage = PostImage::where('id', $id)->delete();

			return $this->httpResponseHandlerService->handleSuccess(new PostImageResource($postImage));
		} catch (\Exception $e) {
			return $this->httpResponseHandlerService->handleError($e->getMessage());
		}
    }
}
