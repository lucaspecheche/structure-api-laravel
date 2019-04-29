<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Models\User;
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
        if ($this->authService->loginUser($request->validated())) {
            return response()->json([
                'message' => "Usuário Autenticado",
                'token' => $this->authService->getTokenAccess()
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => "Falha na Autenticação",
        ], Response::HTTP_UNAUTHORIZED);
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
        $user = User::where('activation_token', $token)->first();
        if (! $user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active           = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }
}
