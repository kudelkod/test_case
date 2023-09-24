<?php

namespace App\Services\Request;

use App\Events\ResolveRequestEvent;
use App\Notifications\ResolveRequestNotification;
use App\Repositories\Request\Contracts\RequestRepositoryInterface;
use App\Services\Request\Contracts\RequestServiceInterface;

class RequestService implements RequestServiceInterface
{
    private RequestRepositoryInterface $requestRepository;

    public function __construct(RequestRepositoryInterface $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    /**
     * @return array{message: string, status: string}
     */
    public function createRequest($data): array
    {
        $result = $this->requestRepository->createRequest($data);

        if (!$result){
            return ['message' => 'Unsuccessful creating', 'status' => 'failed'];
        }
        return ['message' => 'Successful creating', 'status' => 'OK'];
    }

    /**
     * @return array{message: string, status: string}
     */
    public function updateRequest($data, $id): array
    {
        $request = $this->requestRepository->getRequestById($id);

        if ($request->status == "Resolved"){
            return ['message' => 'This request is resolved', 'status' => 'failed'];
        }

        $result = $this->requestRepository->updateRequest($data, $id);

        if (!$result){
            return ['message' => 'Unsuccessful update', 'status' => 'failed'];
        }

//        ResolveRequestEvent::dispatch($request->fresh());
        $request = $request->fresh();
        if ($request->status == "Resolved"){
            $request->notify(new ResolveRequestNotification());
        }

        return ['message' => 'Successful update', 'status' => 'OK'];
    }

    public function getRequests($filters)
    {
        $result = $this->requestRepository->getRequests($filters);

        if (empty($result)){
            return ['message' => 'By request nothing found', 'status' => 'failed'];
        }
        return ['data' => $result, 'status' => 'OK'];
    }
}
