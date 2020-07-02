<?php

namespace Modules\UserModule\Services\Vendor;

use App\User;
use Auth;
use Hash;

class UserService
{
    private $modelRelationships = [
        'details',
        'images',
        'shops'
    ];

    public function __construct()
    {
    }

    public function getAll($params = [], $offset = 0, $limit = 10, $order_by = 'id', $order_type = 'desc')
    {
        $users = User::with($this->modelRelationships)
                    ->when(isset($params['user_id']), function ($query) use ($params) {
                        return $query->where('user_id', $params['user_id']);
                    })
                    ->when(isset($params['name']), function ($query) use ($params) {
                        return $query->where('name', 'LIKE', '%' . $params['name'] . '%');
                    })
                    ->when(isset($params['email']), function ($query) use ($params) {
                        return $query->where('email', 'LIKE', '%' . $params['email'] . '%');
                    })
                    ->when(isset($params['role_name']), function ($query) use ($params) {
                        return $query->where('role_name', 'LIKE', '%' . $params['role_name'] . '%');
                    })
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy($order_by, $order_type)
                    ->get();

        \Log::info('user:get-all ' . \json_encode($users));

        return [
            'data'      => $users,
            'offset'    => $offset,
            'limit'     => $limit 
        ];
    }

    public function getOne($params = [], $order_by = 'id', $order_type = 'asc')
    {
        $user = User::with($this->modelRelationships)
                    ->when(isset($params['id']), function ($query) use ($params) {
                        return $query->where('id', $params['id']);
                    })
                    ->orderBy($order_by, $order_type)
                    ->first();

        \Log::info('user:get-one ' . json_encode($user));

        return $user;
    }

    public function create($params = [])
    {
        if (!isset($params['name'])) {
            throw new Exception('name is not specified', 1);
        }

        if (!isset($params['email'])) {
            throw new Exception('email is not specified', 1);
        }

        if (!isset($params['password'])) {
            throw new Exception('password is not specified', 1);
        }

        $roleName = env('PATRON_ROLE_NAME');

        $user = new User;

        $user->name         = $params['name'];
        $user->email        = $params['email'];
        $user->password     = Hash::make($params['password']);
        $user->role_name    = $roleName;

        if (!$user->save()) {
            throw new Exception('error in saving user', 1);
        }

        \Log::info('user:created ' . \json_encode($user));

        return $user;
    }

    public function update($params = [], $id)
    {
        $user = User::find($id);

        if (isset($params['name'])) {
            $user->name = $params['name'];
        }

        if (isset($params['email'])) {
            $user->email = $params['email'];
        }

        if (!$user->save()) {
            throw new Exception('error in saving user', 1);
        }

        \Log::info('user:updated ' . \json_encode($user));

        return $user;
    }

    public function delete($id = null)
    {
        if (!$id) {
            throw new Exception('id is not specified', 1);
        }

        $user = User::where('id', $id)->delete();

        if (!$user) {
            throw new Exception('error in deleting user-detail', 1);
        }

        \Log::info('user:deleted ' . json_encode($user));

        return $user;
    }
}
