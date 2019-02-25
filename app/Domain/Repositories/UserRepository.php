<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;

class UserRepository extends BaseRepository
{
    protected $model = User::class;

    public function createUser (array $data): bool
    {
        return $this->model
            ->fill($data)
            ->save();
    }


}