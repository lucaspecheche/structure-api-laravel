<?php

namespace App\Exceptions\SystemExceptions;

use App\Exceptions\BuildExceptions;
use Illuminate\Http\Response;

final class UserExceptions
{
    public static function userAuthNotFound()
    {
        return new BuildExceptions([
            'shortMessage' => 'userNotFound',
            'message' => trans('Usuário não foi encontrado, por favor, verifique suas credenciais'),
            'httpCode' => Response::HTTP_NOT_FOUND
        ]);
    }

    public static function userNotActivate()
    {
        return new BuildExceptions([
            'shortMessage' => 'userNotActivate',
            'message' => "Verificamos que sua conta não está ativada, por favor, verifique seu email",
            'httpCode' => Response::HTTP_UNAUTHORIZED
        ]);
    }

    public static function codeNotFound()
    {
        return new BuildExceptions([
            'shortMessage' => 'tokenNotFound',
            'message' => "Código de ativação não encontrado",
            'httpCode' => Response::HTTP_NOT_FOUND
        ]);
    }
}
