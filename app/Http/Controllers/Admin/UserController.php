<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Services\RoleService;
use App\Domain\Services\UserService;
use App\Http\Requests\SignupFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index()
    {
    }

    public function create(SignupFormRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        if ($user) {
            return response()->json([
                'message' => trans('messages.created_user')
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'message' => trans('messages.error_creating_user')
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
