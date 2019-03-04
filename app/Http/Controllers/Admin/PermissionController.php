<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Services\PermissionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionFormResquest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        //
    }

    public function create(PermissionFormResquest $request)
    {
        $data = $request->validated();
        $user = $this->permissionService->createPermission($data);

        if($user) {
            return response()->json([
                'message' => trans('messages.created_permission')
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'message' => trans('messages.error_creating_permission')
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    public function show(Permission $permission)
    {
        //
    }


    public function update(Request $request, Permission $permission)
    {
        //
    }

    public function destroy(Permission $permission)
    {
        //
    }

}
