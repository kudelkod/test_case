<?php

namespace App\Services\Request\Contracts;

interface RequestServiceInterface
{
    public function createRequest($data);

    public function updateRequest($data);
}
