<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public $model = Permission::class;
}