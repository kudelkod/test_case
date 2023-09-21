<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Request;

class JWTAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $token = $request->headers->get('Authorization') ?? '';

        if (strlen($token) <= 7 || strtolower(substr($token, 0, 6)) != 'bearer'){
            return response(['message' => 'Unauthorized', 'status' => 'failed'], 200);
        }

        if (!$token)
        {
            return response()->json(['message' => 'Unauthorized', 'status' => 'failed'], 401);
        }

        try{
            $token = JWT::decode(
                substr($token, 7),
                new Key(env('JWT_SECRET'), env('JWT_ALGORITHM'))
            );
            if ($token->exp < time())
            {
                throw new \Exception();
            }
        }
        catch (\Throwable $e){
            return response()->json(['error' => 'Token expired'], 200);
        }

        return $next($request);
    }
}
