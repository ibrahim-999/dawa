<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Admin\v1\Services\AdminAccessService;
use App\Domains\Admin\v1\Services\AdminService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAuthRequest;
use App\Http\Resources\Driver\AuthDriverData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    private AdminAccessService $accessService;
    private AdminService $adminService;


    public function __construct(
        AdminAccessService $accessService,
        AdminService       $adminService,
    )
    {
        $this->accessService = $accessService;
        $this->adminService = $adminService;

    }

    public function login(AdminAuthRequest $request)
    {
        $admin = $this->adminService->getAdminByEmail($request->email);
        $is_correct = $this->accessService->verifyPassword($admin, $request->password);
        if ($is_correct) {
            $this->accessService->login($admin, $request);
            return Redirect::route('dashboard')->with('success', __('messages.logged_in_success'));

        } else {
            return Redirect::back()->withErrors(['password' => __('validation.invalid_password')]);
        }

    }
    public function logout()
    {
        $admin = $this->adminService->getAuthAdmin('web-admin');
        if ($admin) {
            $this->accessService->logout($admin);
            return Redirect::route('admin.login.view');
        }


    }

}
