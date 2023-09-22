<?php

namespace App\Repositories\Request;

use App\Models\Request;
use App\Repositories\Request\Contracts\RequestRepositoryInterface;
use Illuminate\Support\Carbon;

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

    public function updateRequest($data, $id)
    {
        return $this->request->find($id)->update($data);
    }

    public function getRequests($filters)
    {
        return $this->request
            ->when($filters['status'] ?? null, function ($query, $status){
                return $query->where('status', $status);
            })
            ->when($filters['date'] ?? null, function ($query, $date){
                return $query->whereDate('created_at', Carbon::parse($date)->format('Y-m-d'));
            })
            ->get()
            ->toArray();
    }

    public function getRequestById($id)
    {
        return $this->request->find($id);
    }
}
