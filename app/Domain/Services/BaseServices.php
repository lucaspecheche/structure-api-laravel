<?php

namespace App\Domain\Services;

/**
 * @property UserService userService
 * @property AuthService authService
 */

class BaseServices
{
    const SERVICES = [
        'userService' => UserService::class,
        'authService' => AuthService::class
    ];

    public function __get($service)
    {
        if (! array_key_exists($service, self::SERVICES)) {
            new \Exception("Classe Não encontrada");
        }

        $classname = self::SERVICES[$service];

        return app()->make($classname);
    }
}
