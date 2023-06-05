<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Shared\v1\Services\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\RoleStoreRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{

    private RoleService $roleService;


    public function __construct(
        RoleService       $roleService,
    )
    {
        $this->roleService = $roleService;

        $this->middleware('permission:create_roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_roles', ['only' => ['show']]);
        $this->middleware('permission:update_roles', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_roles', ['only' => ['index']]);
        $this->middleware('permission:delete_roles', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $roles = $this->roleService->search($request)->paginate($itemsPerPage);
        return view('admin/v1/role/index', compact('roles'));
    }

    public function create(Request $request)
    {
        $guard=$request->guard ?? 'web-admin';
        $permissions=$this->roleService->getGuardPermissions($guard)->groupPermissionsByModule();
        return view('admin/v1/role/create',compact('guard','permissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $role = $this->roleService->add($request);
        if ($role) {
            return Redirect::route('roles.index')->with('success', __('messages.role_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function show(Role $role)
    {
        return Redirect::route('roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        $deleted = $this->roleService->delete($role);
        if ($deleted) {
            return Redirect::route('roles.index')->with('success', __('messages.role_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('roles.index')->with('success', __('messages.role_deleted_successfully'));
    }

    public function edit(Role $role)
    {
        $guard=$role->guard_name;
        $permissions=$this->roleService->getGuardPermissions($guard)->groupPermissionsByModule();

       return view('admin/v1/role/edit', compact('guard','permissions','role'));
    }

    public function update(Role $role, RoleUpdateRequest $request)
    {
        $updated = $this->roleService->setBuilder($role)->update($request);
        if ($updated) {
            return Redirect::route('roles.index')->with('success', __('messages.role_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
