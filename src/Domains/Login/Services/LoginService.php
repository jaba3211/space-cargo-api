<?php

namespace Domains\Login\Services;

use App\Exceptions\NotFoundException;
use App\Services\BaseService;

class LoginService extends BaseService
{
    /**
     * @param $username
     * @param $password
     * @return array
     * @throws NotFoundException
     */
    public function login($username, $password): array
    {
        $token = auth()->attempt([
            'username' => $username,
            'password' => $password,
        ]);

        if (!$token) {
            throw new NotFoundException('Incorrect username or password.');
        }
        return $this->respondWithToken($token);
    }


    /**
     * @param $token
     * @return array
     */
    private function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }

}
