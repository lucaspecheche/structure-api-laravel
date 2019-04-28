<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Models\Role;
use App\Domain\Services\RoleService;
use App\Http\Requests\RoleFormResquest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        //
    }


    public function create(RoleFormResquest $request)
    {
        $data = $request->validated();
        $role = $this->roleService->createRole($data);

        if ($role) {
            return response()->json([
                'message' => trans('messages.creating_role')
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'message' => trans('messages.error_creating_role')
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        //
    }

    public function update(Request $request, Role $role)
    {
        //
    }

    public function destroy(Role $role)
    {
        //
    }
}
