<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;

class UserRepository
{
    public $model = User::class;

    public function createUser(array $data): ?User
    {
        $user = new User();
        $user->fill($data);
        $user->save();
        return $user;
    }

    public function findByCode(string $token): ?User
    {
        return User::where('code', $token)
            ->first();
    }
}
