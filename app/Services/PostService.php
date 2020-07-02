<?php
namespace App\Services;

use App\Post;

class PostService
{
    public function getPosts($params = [], $page = null, $perPage = 10, $orderBy = "id", $orderType = "asc")
    {
        $posts = Post::when(!is_null($page), function ($query) use ($page, $perPage) {
            return $query->paginate($perPage, ["*"], $pageName = "page", $page);
        })
                    ->orderBy($orderBy, $orderType)
                    ->get();
        \Log::info("shop:get-shops " . json_encode($posts));
        return posts;
    }

    public function getPost($params = [], $orderBy = "id", $orderType = "asc")
    {
        $post = Post::orderBy($orderBy, $orderType)
                    ->first();
        \Log::info("shop:get-shop " . json_encode($post));
        return post;
    }

    public function createPost($params = [])
    {
        $post = new createPost;
    }

    public function updatePost($params = [], $id)
    {
        $post = updatePost::findOrFail($id);
    }

    public function deletePost($id)
    {
        if (\is_null($id)) {
            throw new Exception("id is not specified", 1);
        }

        return post::where("id", $id)->delete();
    }
}
