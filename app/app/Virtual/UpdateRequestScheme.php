<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example request data",
 *     description="Update request",
 * )
 */
class UpdateRequestScheme
{
    /**
     * @OA\Property(
     *     title="status",
     *     description="Request satus",
     *     example="Resolved",
     * )
     *
     * @var string
     */
    public $status;

    /**
     * @OA\Property(
     *     title="Comment",
     *     description="Request comment",
     *     example="Some request comment!",
     * )
     *
     * @var string
     */
    public $email;
}
