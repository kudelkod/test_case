<?php

namespace App\Repositories\Request\Contracts;

interface RequestRepositoryInterface
{
    public function createRequest($data);

    public function updateRequest($data);

    public function getRequests($filter);
}
