<?php

namespace App\Services\Vendor;

use App\Shop;

class ShopService
{
    public function getShops($params = [], $page = null, $perPage = 10, $orderBy = 'id', $orderType = 'asc')
    {
        $shops = Shop::with([
                        'user',
                        'tags',
                        'images'
                    ])
                    ->when(isset($params['userId']), function ($query) use ($params) {
                        return $query->where('user_id', $params['userId']);
                    })
                    ->when(!\is_null($page), function ($query) use ($page, $perPage) {
                        return $query->paginate($perPage, ['*'], $pageName = 'page', $page);
                    })
                    ->orderBy($orderBy, $orderType)
                    ->get();

        \Log::info('shop:get-shops ' . \json_encode($shops));

        return $shops;
    }

    public function getShop($params = [], $orderBy = 'id', $orderType = 'asc')
    {
        $shop = Shop::with([
                        'user',
                        'tags',
                        'images'
                    ])
                    ->when(isset($params['userId']), function ($query) use ($params) {
                        return $query->where('user_id', $params['userId']);
                    })
                    ->when(isset($params['shopId']), function ($query) use ($params) {
                        return $query->where('id', $params['shopId']);
                    })
                    ->orderBy($orderBy, $orderType)
                    ->first();

        \Log::info('shop:get-shop ' . \json_encode($shop));

        return $shop;
    }

    public function create($params = [])
    {
        $shop = new Shop;

        $shop->user_id      = $userId;
        $shop->name         = $params['name'];
        $shop->description  = $params['description'];
        $shop->address      = $params['address'];
        $shop->latitude     = $params['latitude'];
        $shop->longitude    = $params['longitude'];

        $shop->save();

        \Log::info('shop:created ' . \json_encode($shop));

        return $shop;
    }

    public function deleteShop($shopId = null)
    {
        if (\is_null($shopId)) {
            throw new Exception("shopId is not specified", 1);
        }

        return Shop::where('id', $shopId)->delete();
    }
}
