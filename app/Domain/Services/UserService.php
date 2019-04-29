<?php

namespace App\Domain\Services;

use App\Domain\Models\User;
use App\Domain\Repositories\UserRepository;
use App\Notifications\SignupActivate;

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
        $data['password']         = bcrypt($data['password']);
        $data['activation_token'] = str_random(60);

        $role = $this->roleService->repository->find($data['role_id']);
        $user = $this->repository->createUser($data, $role);
        $user->notify(new SignupActivate($user));
        return $user;
    }

    public function getPermissionsUser(User $user)
    {
        return $this->roleService->repository->find($user);
    }
}
