<?php

namespace App\Repositories\Request\Contracts;

interface RequestRepositoryInterface
{
    public function createRequest($data);

    public function updateRequest($data, $id);

    public function getRequests($filters);

    public function getRequestById($id);
}
