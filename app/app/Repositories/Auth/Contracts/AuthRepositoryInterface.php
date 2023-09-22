<?php

namespace App\Repositories\Auth\Contracts;

interface AuthRepositoryInterface
{
    public function getUserByUsername($username);

    public function createUser($data);

    public function addRefreshToken($refresh_token, $exp_time, $user_id);

    public function deleteToken($refresh_token);

    public function deleteAllUserTokens($user_id);

    public function getRefreshToken($refresh_token);
}
