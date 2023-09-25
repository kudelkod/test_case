<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\Contracts\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *      name="Auth",
 *      description="Auth",
 *  )
 */
class AuthController extends Controller
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *      path="/auth/sign_in",
     *      operationId="Sign in",
     *      tags={"Auth"},
     *      summary="Login",
     *      @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/LoginScheme")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Everything is fine",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Unprocessable content"
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Not found"
     *      )
     *  )
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->safe()->all();
        $response = $this->authService->signInUserByCredentials($credentials);

        if ($response){
            return response()->json($response, 200);
        }

        return response()->json(['message' => 'Not signed in', 'status' => 'failed'], 200);
    }

    /**
     * @OA\Post(
     *      path="/auth/sign_up",
     *      operationId="Sign up",
     *      tags={"Auth"},
     *      summary="Registration",
     *      @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/RegisterScheme")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Everything is fine",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Unprocessable content"
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Not found"
     *      )
     *  )
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function register(LoginRequest $request): JsonResponse
    {
        $data = $request->safe()->all();
        $result = $this->authService->registerUser($data);

        if($result){
            return response()->json(['message' => 'Success registration!', 'status' => 'OK'], 200);
        }

        return response()->json(['message' => 'Not registered', 'status' => 'failed'], 200);
    }

    /**
     * @OA\Post(
     *       path="/auth/refresh",
     *       operationId="Refresh tokens",
     *       tags={"Auth"},
     *       summary="Refresh",
     *       @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(ref="#/components/schemas/RefreshScheme")
     *       ),
     *       @OA\Response(
     *           response="200",
     *           description="Everything is fine",
     *       ),
     *       @OA\Response(
     *           response="404",
     *           description="Not found"
     *       )
     *   )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request): JsonResponse
    {
        $refresh_token = $request->refresh_token ?? null;
        $response = $this->authService->refreshUserToken($refresh_token);

        return response()->json($response, 200);
    }

    /**
     * @OA\Post(
     *        path="/auth/logout",
     *        operationId="Logout",
     *        tags={"Auth"},
     *        summary="Logout",
     *        @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/RefreshScheme")
     *        ),
     *        @OA\Response(
     *            response="200",
     *            description="Everything is fine",
     *        ),
     *        @OA\Response(
     *            response="404",
     *            description="Not found"
     *        )
     *    )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $refresh_token = $request->refresh_token ?? null;
        $response = $this->authService->logout($refresh_token);

        return response()->json($response, 200);
    }
}
