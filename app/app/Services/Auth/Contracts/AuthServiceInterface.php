<?php

namespace App\Services\Auth\Contracts;

interface AuthServiceInterface
{
    public function signInUserByCredentials($credentials);

    public function registerUser($data);

    public function refreshUserToken($refresh_token);

    public function logout($refresh_token);
}
