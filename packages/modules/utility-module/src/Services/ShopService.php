<?php

namespace Modules\ShopModule\Services;

use Modules\ShopModule\Models\Shop;

class ShopService
{
    public function getAll($params = [], $offset = 0, $limit = 10, $order_by = 'id', $order_type = 'desc')
    {
        $shops = Shop::with([
                        'user',
                        'tags',
                        'images'
                    ])
                    ->when(isset($params['user_id']), function ($query) use ($params) {
                        return $query->where('user_id', $params['user_id']);
                    })
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy($order_by, $order_type)
                    ->get();

        \Log::info('shop:get-shops ' . \json_encode($shops));

        return [
            'data'      => $shops,
            'offset'    => $offset,
            'limit'     => $limit 
        ];
    }

    public function getOne($params = [], $order_by = 'id', $order_type = 'asc')
    {
        $shop = Shop::with([
                        'user',
                        'tags',
                        'images'
                    ])
                    ->when(isset($params['user_id']), function ($query) use ($params) {
                        return $query->where('user_id', $params['user_id']);
                    })
                    ->when(isset($params['id']), function ($query) use ($params) {
                        return $query->where('id', $params['id']);
                    })
                    ->orderBy($order_by, $order_type)
                    ->first();

        \Log::info('shop:get-shop ' . json_encode($shop));

        return $shop;
    }

    public function create($params = [])
    {
        $shop = new Shop;

        $shop->user_id      = $params['user_id'];
        $shop->name         = $params['name'];
        $shop->description  = $params['description'];
        $shop->address      = $params['address'];
        $shop->latitude     = $params['latitude'];
        $shop->longitude    = $params['longitude'];

        if (!$shop->save()) {
            return null;
        }

        \Log::info('shop:created ' . \json_encode($shop));

        return $shop;
    }

    public function update($params = [], $id)
    {
        $shop = Shop::find($id);

        $shop->user_id      = $params['user_id'];
        $shop->name         = $params['name'];
        $shop->description  = $params['description'];
        $shop->address      = $params['address'];
        $shop->latitude     = $params['latitude'];
        $shop->longitude    = $params['longitude'];

        if (!$shop->save()) {
            return null;
        }

        \Log::info('shop:created ' . \json_encode($shop));

        return $shop;
    }

    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new Exception("id is not specified", 1);
        }

        return Shop::where('id', $id)->delete();
    }
}
