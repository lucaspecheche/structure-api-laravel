<?php

namespace App\Providers;

use App\Domain\Repositories\RoleRepository;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register()
    {
        app()->bind(UserRepository::class, function () {
            return new UserRepository();
        });

        app()->bind(RoleRepository::class, function () {
            return new RoleRepository();
        });
    }

    public function boot()
    {
        //
    }
}
