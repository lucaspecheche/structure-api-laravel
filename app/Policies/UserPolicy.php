<?php

namespace App\Policies;

use App\Domain\Enumerators\UserPermissions;
use App\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
    }

    public function createUser(User $user, array $data)
    {
        return $user->hasPermission(UserPermissions::CREATE);
    }

    public function update(User $user)
    {
        //
    }
}
