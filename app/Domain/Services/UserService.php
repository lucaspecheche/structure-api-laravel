<?php

namespace App\Domain\Services;

use App\Domain\Repositories\UserRepository;

class UserService extends BaseServices
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(array $user): bool
    {
        $user['password'] = bcrypt($user['password']);
        return $this->repository->createUser($user);
    }

    public function teste($id)
    {
        dd($this->repository->find($id));
    }
}