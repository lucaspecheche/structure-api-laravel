<?php

namespace App\Domain\Services;

use App\Domain\Models\User;
use App\Domain\Repositories\UserRepository;

class UserService extends BaseServices
{
    /**
     * @var UserRepository
     */
    public $repository;

    protected $roleService;

    public function __construct(UserRepository $repository, RoleService $roleService)
    {
        $this->repository  = $repository;
        $this->roleService = $roleService;
    }

    public function createUser(array $data): ?User
    {
        $data['password'] = bcrypt($data['password']);
        $role             = $this->roleService->repository->find($data['role_id']);
        return $this->repository->createUser($data, $role);
    }

    public function getPermissionsUser(User $user)
    {
        return $this->roleService->repository->find(2);
    }
}
