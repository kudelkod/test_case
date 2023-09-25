<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\CreateRequest;
use App\Http\Requests\Request\GetRequests;
use App\Http\Requests\Request\UpdateRequest;
use App\Services\Request\Contracts\RequestServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

/**
 * @OA\Tag(
 *      name="Request",
 *      description="Request",
 *  )
 */
class RequestController extends Controller
{
    private RequestServiceInterface $requestService;

    public function __construct(RequestServiceInterface $requestService)
    {
        $this->requestService = $requestService;
    }

    /**
     * @OA\Post(
     *       path="/requests",
     *       operationId="Create request",
     *       tags={"Request"},
     *       summary="Create request",
     *       @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(ref="#/components/schemas/CreateRequestScheme")
     *       ),
     *       @OA\Response(
     *           response="200",
     *           description="Everything is fine",
     *       ),
     *       @OA\Response(
     *           response="422",
     *           description="Unprocessable content"
     *       ),
     *       @OA\Response(
     *           response="404",
     *           description="Not found"
     *       ),
     *   )
     *
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function createRequest(CreateRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->safe()->all();

        $response = $this->requestService->createRequest($data);

        return response()->json($response, 200);
    }

    /**
     * @OA\Get(
     *       path="/requests",
     *       operationId="Get requests",
     *       tags={"Request"},
     *       summary="Get requests",
     *       security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          description="Request status",
     *          required=false,
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter(
     *           name="date",
     *           in="query",
     *           description="Request date",
     *           required=false,
     *           @OA\Schema(
     *               type="string",
     *           )
     *       ),
     *       @OA\Response(
     *           response="200",
     *           description="Everything is fine",
     *       ),
     *       @OA\Response(
     *           response="422",
     *           description="Unprocessable content"
     *       ),
     *       @OA\Response(
     *           response="404",
     *           description="Not found"
     *       ),
     *       @OA\Response(
     *           response="401",
     *           description="Unauthorized"
     *        ),
     *   )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getRequests(Request $request): JsonResponse
    {
        $filters = $request->query();

        $response = $this->requestService->getRequests($filters);

        return response()->json($response, 200);
    }

    /**
     * @OA\Put(
     *       path="/requests/{id}",
     *       operationId="Update request",
     *       tags={"Request"},
     *       summary="Update request",
     *       security={{"bearerAuth":{}}},
     *       @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="The ID of request",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *       ),
     *       @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(ref="#/components/schemas/UpdateRequestScheme")
     *       ),
     *       @OA\Response(
     *           response="200",
     *           description="Everything is fine",
     *       ),
     *       @OA\Response(
     *           response="422",
     *           description="Unprocessable content"
     *       ),
     *       @OA\Response(
     *           response="404",
     *           description="Not found"
     *       ),
     *       @OA\Response(
     *           response="401",
     *           description="Unauthorized"
     *        ),
     *   )
     *
     * @param UpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function resolveRequest(UpdateRequest $request, $id)
    {
        $data = $request->safe()->all();

        $response = $this->requestService->updateRequest($data, $id);

        return response()->json($response, 200);
    }
}
