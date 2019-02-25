<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Services\AuthService;
use App\Domain\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupFormRequest;
use App\Http\Requests\SigninFormRequest;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    protected $userService;
    protected $authService;

    public function __construct(
        UserService $userService,
        AuthService $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function signup(SignupFormRequest $request)
    {
       $user = $this->userService->createUser($request->validated());
       if($user){
           return response()->json([
               'message' => "Sucesso ao Cadastrar User"
           ], Response::HTTP_CREATED);
       }

        return response()->json([
            'message' => "Erro ao Cadastrar User"
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function signin(SigninFormRequest $request)
    {
        if($this->authService->loginUser($request->validated())){
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
        if($this->authService->logoutUser()){
            return response()->json([
                'message' => "Vc saiu com sucesso"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => "Ocorreu um erro ao fazer Logout"
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    public function teste()
    {
        return response()->json([
            'message' => "Caiu no Teste"
        ], Response::HTTP_OK);
    }
}
