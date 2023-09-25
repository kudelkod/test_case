<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example request data",
 *     description="Refresh request",
 * )
 */
class RefreshScheme
{
    /**
     * @OA\Property(
     *     title="Refresh token",
     *     description="User refresh token",
     *     example="supersecrettoken123",
     * )
     *
     * @var string
     */
    public $token;
}
