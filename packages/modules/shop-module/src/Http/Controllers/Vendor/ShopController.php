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
    public function index(Request $request)
    {
        try {
            $context = new \ZMQContext();
            $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
            $socket->connect("tcp://localhost:5555");

            $socket->send(json_encode($entryData));

            $shops = ShopService::all([], $request->input('offset'));

            return HttpResponse::success(ShopResource::collection($shops['data']));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $user = Auth::user();

            $shop = ShopService::one(['id' => $id]);

            return HttpResponse::success(new ShopResource($shop));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function store(ShopRequest $request)
    {
        try {
            $user = Auth::user();

            $shop = ShopService::create([
                'user_id' => $userId,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'address' => $request->input('address'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);

            return HttpResponse::success(new ShopResource($shop));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $user = Auth::user();

            $shop = ShopService::update(
                [
                    'user_id' => $user->id,
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'address' => $request->input('address'),
                    'latitude' => $request->input('latitude'),
                    'longitude' => $request->input('longitude'),
                ],
                $id
            );

            return HttpResponse::success(new ShopResource($shop));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $shop = ShopService::delete($id);

            return HttpResponse::success(new ShopResource($shop));
        } catch (\Exception $e) {
            return HttpResponse::error($e->getMessage());
        }
    }
}
