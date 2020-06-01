<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use App\Services\HttpResponseHandlerService;
use App\Services\Vendor\ShopService;

class ShopController extends Controller
{
    private $httpResponseHandlerService;

    public function __construct()
    {
        $this->httpResponseHandlerService = new HttpResponseHandlerService;
    }

    public function getShops(Request $request, ShopService $shopService)
    {
        try {
            $user = Auth::user();

            $params = [
                'userId' => $user->id
            ];

            $shops = $shopService->shops($params, $request->input('page'));

            return $this->httpResponseHandlerService->handleSuccess(PostResource::collection($shops));
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function getShop(Request $request, ShopService $shopService)
    {
        try {
            $user = Auth::user();

            $params = [
                'shopId' => $request->input('shop_id')
            ];

            $shop = $shopService->shop($params);

            return $this->httpResponseHandlerService->handleSuccess(new PostResource($shop));
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function createShop(PostStoreRequest $request)
    {
        try {
            $user = Auth::user();

            $shop = new Shop;

            $shop->user_id      = $userId;
            $shop->title        = $request->input('title');
            $shop->description  = $request->input('description');

            $shop->save();

            return $this->httpResponseHandlerService->handleSuccess($shop);
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function updatePost(PostUpdateRequest $request, $id)
    {
        try {
            $user = Auth::user();

            $userPost = UserPost::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->first();

            if (!$userPost) {
                return $this->httpResponseHandlerService->handleError('No shop found', 404);
            }

            $userPost->title        = $request->input('title');
            $userPost->description  = $request->input('description');

            $userPost->save();

            return $this->httpResponseHandlerService->handleSuccess($userPost);
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }

    public function deletePost($id)
    {
        try {
            $user = Auth::user();

            $userPost = UserPost::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->delete();

            return $this->httpResponseHandlerService->handleSuccess(new PostResource($userPost));
        } catch (\Exception $e) {
            return $this->httpResponseHandlerService->handleError($e->getMessage());
        }
    }
}
