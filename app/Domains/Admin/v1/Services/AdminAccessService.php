<?php

namespace App\Domains\Admin\v1\Services;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAccessService
{
    private AdminService $adminService;

    public function __construct(
        AdminService $adminService,
    )
    {
        $this->adminService = $adminService;
    }


    public function verifyPassword(Model $admin, $password): ?bool
    {
        try {
            return Hash::check($password, $admin->password);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function login(Model $admin, $request)
    {
        try {
            auth('web-admin')->login($admin, isset($request->remember_me));
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function logout()
    {
        try {
            auth('web-admin')->logout();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
