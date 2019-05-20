<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigninFormRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signin(SigninFormRequest $request)
    {
        $token = $this->authService->loginUser($request->validated());

            return response()->json([
                'message' => "Usuário Autenticado com sucesso",
                'token' => $token
            ], Response::HTTP_OK);
    }

    public function signout()
    {
        if ($this->authService->logoutUser()) {
            return response()->json([
                'message' => "Vc saiu com sucesso"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => "Ocorreu um erro ao fazer Logout"
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function signupActivate($token)
    {
        $this->authService->activateUser($token);

        return response()->json([
            'message' => "Conta confirmada com sucesso!"
        ], Response::HTTP_OK);
    }
}
