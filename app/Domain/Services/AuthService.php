<?php

namespace App\Domain\Services;

use Illuminate\Support\Facades\Auth;

class AuthService extends BaseServices
{
    public function loginUser(array $credentials): bool
    {
        $credentials['active']     = 1;
        $credentials['deleted_at'] = null;

        if ($auth = Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    public function getTokenAccess()
    {
        return  $this->getUserAuth()->createToken('Access Token')->accessToken;
    }

    public function getUserAuth()
    {
        return Auth::user();
    }

    public function logoutUser(): bool
    {
        $user = $this->getUserAuth();
        return $user->token()->revoke();
    }
}
