<?php

namespace App\Domain\Services;

use App\Domain\Models\User;
use App\Domain\Repositories\RoleRepository;
use App\Domain\Repositories\UserRepository;
use App\Notifications\SignupActivate;

class UserService extends BaseServices
{
    /**
     * @var UserRepository
     */
    public $repository;

    protected $roleService;
    protected $roleRepository;

    public function __construct(UserRepository $repository, RoleService $roleService, RoleRepository $roleRepository)
    {
        $this->repository     = $repository;
        $this->roleService    = $roleService;
        $this->roleRepository = $roleRepository;
    }

    public function createUser(array $data): ?User
    {
        $data['password'] = bcrypt($data['password']);
        $data['code']     = str_random(60);

        $user = $this->repository->createUser($data);
        $user->notify(new SignupActivate());
        return $user;
    }

    public function getPermissionsUser(User $user)
    {
        return $this->roleService->repository->find($user);
    }
}
