<?php

namespace App\Services\Request;

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
    public function updateRequest($data): array
    {
        $result = $this->requestRepository->updateRequest($data);

        if (!$result){
            return ['message' => 'Unsuccessful update', 'status' => 'failed'];
        }
        return ['message' => 'Successful update', 'status' => 'OK'];
    }
}
