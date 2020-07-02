<?php

namespace App\Services;

use Log;

class HttpResponseService
{
    public function __construct()
    {
    }

    public static function error($errorMessage, $statusCode = 500)
    {
        if (!$errorMessage) {
            throw new Exception("No errorMessage is given", 1);
        }

        Log::error('Http Error Response: ' . $errorMessage);
        
        return response()->json([
            'success'   => (bool) false,
            'error' 	=> $errorMessage
        ], $statusCode);
    }

    public static function success($data, $statusCode = 200)
    {
        if (!$data) {
            throw new \Exception("No data given", 1);
        }

        return response()->json([
            'success'   => (bool) true,
            'data'      => $data
        ], $statusCode);
    }
}
