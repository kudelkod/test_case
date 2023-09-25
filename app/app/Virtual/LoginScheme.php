<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example login data",
 *     description="Login request",
 * )
 */
class LoginScheme
{
    /**
     * @OA\Property(
     *     title="Username",
     *     description="User username",
     *     example="admin",
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="user password",
     *     example="admin",
     * )
     *
     * @var string
     */
    public $password;
}
