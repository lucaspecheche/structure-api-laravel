<?php

namespace App\Domain\Enumerators;

final class UserPermissions
{
    const NAME = "USER";

    const CREATE = self::NAME.'.CREATE';
    const EDIT   = self::NAME.'.EDIT';
    const SHOW   = self::NAME.'.SHOW';
}
