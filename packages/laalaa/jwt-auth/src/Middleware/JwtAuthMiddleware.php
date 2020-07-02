<?php

namespace LaaLaa\JwtAuth\Middleware;

use Closure;
use LaaLaa\JwtAuth\Services\JwtService;;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = JwtService::getBearerToken($request);

        $decoded_token = JwtService::verifyToken($token);
        
        if (!$decoded_token) {
        	return response()->json([
                'error' => 'unauthorized'
            ], 401);
        }

        return $next($request);
    }
}