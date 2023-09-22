<?php

namespace App\Services\Auth;

use App\Repositories\Auth\Contracts\AuthRepositoryInterface;
use App\Services\Auth\Contracts\AuthServiceInterface;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    private AuthRepositoryInterface $authRepository;
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param $credentials
     * @return mixed
     */
    public function signInUserByCredentials($credentials): mixed
    {
        return DB::transaction(function () use ($credentials){
            $user = $this->authRepository->getUserByUsername($credentials['username']);

            if (!$user){
                return ['message' => 'Invalid username'];
            }
            if (!Hash::check($credentials['password'], $user->password)){
                return ['message' => 'Invalid password'];
            }

            $tokens = $this->createUserTokens($user);

            $this->authRepository->addRefreshToken($tokens['refresh_token'], $tokens['refresh_exp'], $user->id);
            unset($tokens['refresh_exp']);
            $tokens['status'] = 'OK';

            return $tokens;
        });
    }

    /**
     * @param $data
     * @return mixed
     */
    public function registerUser($data): mixed
    {
        return $this->authRepository->createUser($data);
    }

    /**
     * @param $refresh_token
     * @return string[]
     */
    public function refreshUserToken($refresh_token): array
    {
        $token = $this->checkToken($refresh_token);

        if (!$token){
            return ['message' => 'Token expired', 'status' => 'failed'];
        }

        return DB::transaction(function () use ($refresh_token, $token){
            $user = $this->authRepository->getUserByUsername($token->sub);

            $deleteResult = $this->authRepository->deleteToken($refresh_token);

            if (!$deleteResult)
            {
                return ['message' => 'Token expired', 'status' => 'failed'];
            }

            $tokens = $this->createUserTokens($user);

            $this->authRepository->addRefreshToken($tokens['refresh_token'], $tokens['refresh_exp'], $user->id);
            unset($tokens['refresh_exp']);
            $tokens['status'] = 'OK';

            return $tokens;
        });

    }

    /**
     * @param $refresh_token
     * @return mixed|string[]
     */
    public function logout($refresh_token): mixed
    {
        $token = $this->checkToken($refresh_token);

        if (!$token){
            return ['message' => 'Token expired', 'status' => 'failed'];
        }

        return DB::transaction(function () use ($refresh_token){
            $userToken = $this->authRepository->getRefreshToken($refresh_token);

            if ($userToken){
                $this->authRepository->deleteAllUserTokens($userToken->user_id);
                return ['message' => 'Success logout', 'status' => 'OK'];
            }
            return ['message' => 'Token expired', 'status' => 'failed'];
        });
    }

    /**
     * @param $sub
     * @param $iat
     * @param $exp
     * @return string
     */
    private function createToken($sub, $iat, $exp): string
    {

        $payload_access = [
            'aud' => 'test-case',
            'iat' => $iat,
            'exp' => $exp,
            'sub' => $sub,
        ];

        return JWT::encode($payload_access, env('JWT_SECRET'), env('JWT_ALGORITHM'));
    }

    /**
     * @param $user
     * @return array
     */
    private function createUserTokens($user): array
    {
        $sub = $user->username;
        $iat = time();
        $access_exp = time() + 3600;
        $refresh_exp = time() + 86400;

        $access_token = $this->createToken($sub, $iat, $access_exp);
        $refresh_token = $this->createToken($sub, $iat, $refresh_exp);

        return ['access_token' => $access_token, 'refresh_token' => $refresh_token, 'refresh_exp' => $refresh_exp];
    }

    /**
     * @param $refresh_token
     * @return bool|\stdClass
     */
    private function checkToken($refresh_token): bool|\stdClass
    {
        try{
            $token = getRefreshTokenData($refresh_token);
            if ($token->exp < time())
            {
                throw new \Exception();
            }

            return $token;
        }
        catch (\Throwable $e){
            return false;
        }
    }
}
