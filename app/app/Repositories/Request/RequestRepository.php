<?php

namespace App\Repositories\Request;

use App\Models\Request;
use App\Repositories\Request\Contracts\RequestRepositoryInterface;

class RequestRepository implements RequestRepositoryInterface
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function createRequest($data)
    {
        return $this->request->create($data);
    }

    public function updateRequest($data)
    {
        return $this->request->find($data['id'])->update($data);
    }

    public function getRequests($filter)
    {

    }
}
