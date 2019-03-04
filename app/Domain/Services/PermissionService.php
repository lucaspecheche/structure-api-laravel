<?php

namespace App\Domain\Services;

use App\Domain\Repositories\PermissionRepository;

class PermissionService extends BaseServices
{
    protected $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createPermission($data): bool
    {
        return $this->repository->create($data);
    }

}