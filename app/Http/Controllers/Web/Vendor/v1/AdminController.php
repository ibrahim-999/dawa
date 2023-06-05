<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Admin\v1\Services\AdminAccessService;
use App\Domains\Admin\v1\Services\AdminService;
use App\Domains\Shared\v1\Services\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorAuthRequest;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Http\Resources\Driver\AuthDriverData;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    private AdminAccessService $accessService;
    private AdminService $adminService;
    private RoleService $roleService;


    public function __construct(
        AdminAccessService $accessService,
        AdminService       $adminService,
        RoleService        $roleService,
    )
    {
        $this->accessService = $accessService;
        $this->adminService = $adminService;
        $this->roleService = $roleService;

        $this->middleware('permission:create_admins', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_admins', ['only' => ['show']]);
        $this->middleware('permission:update_admins', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_admins', ['only' => ['index']]);
        $this->middleware('permission:delete_admins', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $admins = $this->adminService->search($request)->getCollection()->paginate($itemsPerPage);
        return view('admin/v1/admin/index', compact('admins'));
    }

    public function create()
    {
        $roles = $this->adminService->getAdminsRoles();
        return view('admin/v1/admin/create', compact('roles'));
    }

    public function store(AdminStoreRequest $request)
    {

        $admin = $this->adminService->addAdmin($request);
        if ($admin) {
            return Redirect::route('admins.index')->with('success', __('messages.admin_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function show(Admin $admin)
    {
        return Redirect::route('admins.show', compact('admin'));
    }

    public function destroy(Admin $admin)
    {
        $deleted = $this->adminService->deleteAdmin($admin);
        if ($deleted) {
            return Redirect::route('admins.index')->with('success', __('messages.admin_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('admins.index')->with('success', __('messages.admin_deleted_successfully'));
    }

    public function edit(Admin $admin)
    {
        $roles = $this->adminService->getAdminsRoles();
        return view('admin/v1/admin/edit', compact('admin', 'roles'));
    }

    public function update(Admin $admin, AdminUpdateRequest $request)
    {
        $updated = $this->adminService->updateAdmin($request, $admin);
        if ($updated) {
            return Redirect::route('admins.index')->with('success', __('messages.admin_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
