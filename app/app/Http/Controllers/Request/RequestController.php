<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Services\Request\Contracts\RequestServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RequestController extends Controller
{
    private RequestServiceInterface $requestService;

    public function __construct(RequestServiceInterface $requestService)
    {
        $this->requestService = $requestService;
    }

    public function createRequest(CreateRequest $request)
    {
        $data = $request->safe()->all();

        $response = $this->requestService->createRequest($data);

        return response()->json($response, 200);
    }

    public function getRequests()
    {
        dd(1);
    }

    public function resolveRequest(UpdateRequest $request, $id)
    {
        $data = $request->safe()->all();
        $data['id'] = $id;

        $response = $this->requestService->updateRequest($data);

        return response()->json($response, 200);
    }
}
