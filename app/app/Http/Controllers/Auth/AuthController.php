<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\Contracts\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('username', 'password');
        $response = $this->authService->signInUserByCredentials($credentials);

        if ($response){
            return response()->json($response, 200);
        }

        return response()->json(['message' => 'Not signed in', 'status' => 'failed'], 200);
    }

    public function register(Request $request): JsonResponse
    {
        $data = $request->only('username', 'password');
        $result = $this->authService->registerUser($data);

        if($result){
            return response()->json(['message' => 'Success registration!', 'status' => 'OK'], 200);
        }

        return response()->json(['message' => 'Not registered', 'status' => 'failed'], 200);
    }

    public function refresh(Request $request): JsonResponse
    {
        $refresh_token = $request->refresh_token ?? null;
        $response = $this->authService->refreshUserToken($refresh_token);

        return response()->json($response, 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $refresh_token = $request->refresh_token ?? null;
        $response = $this->authService->logout($refresh_token);

        return response()->json($response, 200);
    }
}
