<?php

namespace Modules\ShopModule\Services\Vendor;

use Modules\ShopModule\Models\Shop;

class ShopService
{
    private $modelRelationships = [
        'user',
        'images',
        'items',
        'utilities',
    ];

    public static function all(
        array $params,
        int $offset = 0,
        int $limit = 10,
        string $order_by = 'id',
        string $order_type = 'desc'
    ): object
    {
        $shops = Shop::with($this->modelRelationships)
            ->when(isset($params['user_id']), function ($query) use ($params) {
                return $query->where('user_id', $params['user_id']);
            })
            ->when(isset($params['name']), function ($query) use ($params) {
                return $query->where('name', 'LIKE', '%' . $params['name'] . '%');
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

    public static function one(
        array $params,
        string $order_by = 'id',
        string $order_type = 'asc'
    ): object
    {
        $shop = Shop::with($this->modelRelationships)
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

    public static function create(array $params): object
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

    public static function update(array $params, int $id): object
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

        \Log::info('shop:updated ' . \json_encode($shop));

        return $shop;
    }

    public static function delete(int $id): object
    {
        \Log::info('shop:deleted ' . \json_encode($shop));

        return Shop::where('id', $id)->delete();
    }
}
