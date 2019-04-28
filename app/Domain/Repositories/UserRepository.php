<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Role;
use App\Domain\Models\User;

class UserRepository extends BaseRepository
{
    protected $model = User::class;

    public function createUser(array $data, Role $role): ?User
    {
        $user = new User();
        $user->fill($data);
        $user->save();
        return $user;
    }
}
