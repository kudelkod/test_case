<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Models\UserRefreshToken;
use App\Repositories\Auth\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    private User $user;
    private UserRefreshToken $userRefreshToken;

    public function __construct(User $user, UserRefreshToken $userRefreshToken)
    {
        $this->userRefreshToken = $userRefreshToken;
        $this->user = $user;
    }

    public function getUserByUsername($username)
    {
        return $this->user->where('username', $username)->first();
    }

    public function createUser($data)
    {
        return $this->user->create([
            'username' => $data['name'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function addRefreshToken($refresh_token, $exp_time, $user_id)
    {
        return $this->userRefreshToken->create([
            'refresh_token' => $refresh_token,
            'refresh_token_exp_time' => $exp_time,
            'user_id' => $user_id
        ]);
    }

    public function deleteToken($refresh_token)
    {
        return $this->userRefreshToken->where('refresh_token', $refresh_token)->delete();
    }

    public function deleteAllUserTokens($user_id)
    {
        return $this->userRefreshToken->where('user_id', $user_id)->delete();
    }

    public function getRefreshToken($refresh_token)
    {
        return $this->userRefreshToken->where('refresh_token', $refresh_token)->first();
    }
}
