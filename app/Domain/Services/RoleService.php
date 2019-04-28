<?php

namespace App\Domain\Services;

use App\Domain\Models\Role;
use App\Domain\Models\User;
use App\Domain\Repositories\RoleRepository;

class RoleService extends BaseServices
{

    /**
     * @var RoleRepository
     */
    public $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createRole($data)
    {
        return $this->repository->create($data);
    }

    public function associateUserToRole(User $user, Role $role)
    {
        return $this->repository->associateUserToRole($user, $role);
    }

    public function findRole($id)
    {
        return $this->repository->find($id);
    }
}
