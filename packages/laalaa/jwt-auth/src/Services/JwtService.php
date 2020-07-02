<?php

namespace LaaLaa\JwtAuth\Services;

require __DIR__ . '/../../vendor/autoload.php';

class JwtService
{
	public static function createToken($user): string
	{
		if (!$user) {
			throw new Exception('user is not specified', 1);
		}

		$key = self::_getKey('private');

		$payload = [
		    'iss' 	=> env('APP_URL'),
		    'aud' 	=> env('APP_URL'),
		    'iat' 	=> time(),
		    'nbf' 	=> time(),
		    'user' 	=> $user
		];

		return self::_encode($payload);
	}

	public static function verifyToken($token): array
	{
		if (!$token) {
			throw new Exception('token is not specified', 1);
		}

		\Firebase\JWT\JWT::$leeway = 10;

		return self::_decode($token);
	}

	// public static function auth(): object
	// {
	// 	$token = self::getBearerToken();

	// 	$decoded_token = self::_decode($token);

	// 	return $decoded_token->user;
	// }

	private static function _encode(array $payload): string
	{
		$key = self::_getKey('private');

		return \Firebase\JWT\JWT::encode($payload, $key, 'RS256');
	}

	private static function _decode($token): object
	{
		$key = self::_getKey('public');

		return \Firebase\JWT\JWT::decode($token, $key, array('RS256'));
	}

	private static function _getKey($key): string
	{
		if ($key !== 'private' || $key !== 'public') {
			throw new Exception('get key params is wrong', 1);
		}

		$_key = $key === 'private' ? 'private-key.pem' : 'public-key.pem';

		$file = fopen(__DIR__ . '/../Keys/' . $_key, 'r');
		$cert = fread($file, 8192);
		fclose($file);

		return $cert;
	}

	public static function getBearerToken($request): string
    {
    	$has_authorization_header = $request->hasHeader('Authorization');

    	if (!$has_authorization_header) {
    		throw new Exception('authorization header is not specified', 1);
    	}

    	$authorization_header = $request->header('Authorization');

    	$token = explode(' ', $authorization_header);

    	return $token[1];
    }
}