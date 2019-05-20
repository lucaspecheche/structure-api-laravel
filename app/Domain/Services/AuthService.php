<?php

namespace App\Domain\Services;

use App\Domain\Models\User;
use App\Domain\Repositories\UserRepository;
use App\Exceptions\SystemExceptions\UserExceptions;
use App\Notifications\SignupActivate;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseServices
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginUser(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return $this->checkActivation();
        }

        throw UserExceptions::userAuthNotFound();
    }

    public function getTokenAccess()
    {
        return  $this->userAuth()->createToken('Access Token')->accessToken;
    }

    public function userAuth(): User
    {
        return auth()->user();
    }

    public function logoutUser(): bool
    {
        $user = $this->userAuth();
        return $user->token()->revoke();
    }

    public function checkActivation()
    {
        if ($this->userAuth()->isActive()) {
            return $this->getTokenAccess();
        }

        $this->resendUserConfirmation();
        throw UserExceptions::userNotActivate();
    }

    public function resendUserConfirmation()
    {
        $this->userAuth()->notify(new SignupActivate());
    }

    public function activateUser($token)
    {
        $user = $this->userRepository->findByCode($token);

        if (is_null($user)) {
            throw UserExceptions::codeNotFound();
        }

        $user->active = true;
        $user->save();

        return $user;
    }
}
