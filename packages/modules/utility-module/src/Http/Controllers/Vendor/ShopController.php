<?php

namespace Modules\ShopModule\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HttpResponseService as HttpResponse;

use Modules\ShopModule\Services\Vendor\ShopService;
use Modules\ShopModule\Http\Requests\Vendor\Shop\ShopCreateRequest;
use Modules\ShopModule\Http\Resources\Vendor\ShopResource;
use Auth;

class ShopController extends Controller
{
    public function getShops(Request $request, ShopService $shopService)
    {
        try {
            $user = Auth::user();

            $params = [
                'user_id' => $user->id
            ];

            $shops = $shopService->getAll($params, $request->input('offset'));

            return HttpResponse::success(ShopResource::collection($shops['data']));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function getShop(Request $request, ShopService $shopService)
    {
        try {
            $user = Auth::user();

            $params = [
                'shop_id' => $request->input('shop_id')
            ];

            $shop = $shopService->getOne($params);

            return HttpResponse::success(new ShopResource($shop));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function createShop(ShopRequest $request, ShopService $shopService)
    {
        try {
            $user = Auth::user();

            $shop = $shopService->create([
                'user_id'       => $userId,
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'address'       => $request->input('address'),
                'latitude'      => $request->input('latitude'),
                'longitude'     => $request->input('longitude'),
            ]);

            return HttpResponse::success(new ShopResource($shop));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function updateShop(PostUpdateRequest $request, ShopService $shopService, $id)
    {
        try {
            $user = Auth::user();

            $shop = $shopService->update(
                [
                    'user_id'       => $user->id,
                    'name'          => $request->input('name'),
                    'description'   => $request->input('description'),
                    'address'       => $request->input('address'),
                    'latitude'      => $request->input('latitude'),
                    'longitude'     => $request->input('longitude'),
                ],
                $id
            );

            return HttpResponse::success(new ShopResource($shop));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function deleteShop(ShopService $shopService, $id)
    {
        try {
            $user = Auth::user();

            $shop = Shop::where('id', $id)->delete();

            $shop = $shopService->delete($id);

            return HttpResponse::success(new ShopResource($shop));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }
}
