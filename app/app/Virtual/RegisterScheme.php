<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example request data",
 *     description="Regitration request",
 * )
 */
class RegisterScheme
{
    /**
     * @OA\Property(
     *     title="Username",
     *     description="User username",
     *     example="superadmin",
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="user password",
     *     example="superadmin",
     * )
     *
     * @var string
     */
    public $password;
}
