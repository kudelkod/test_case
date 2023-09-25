<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example request data",
 *     description="Create request",
 * )
 */
class CreateRequestScheme
{
    /**
     * @OA\Property(
     *     title="name",
     *     description="User name",
     *     example="Tom",
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     title="Email",
     *     description="User email",
     *     example="tom123@gmail.com",
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *     title="Message",
     *     description="User message",
     *     example="Some request message!",
     * )
     *
     * @var string
     */
    public $message;
}
