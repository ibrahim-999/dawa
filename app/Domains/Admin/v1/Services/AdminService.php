<?php

namespace App\Domains\Admin\v1\Services;

use App\Domains\Admin\v1\Contracts\Services\AdminServiceContract;
use App\Domains\Shared\v1\Services\RoleService;
use App\Jobs\SendSetPasswordEmailJob;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminService implements AdminServiceContract
{
    private Admin $adminModel;
    private RoleService $roleService;
    private ResetPasswordService $resetPasswordService;


    public function __construct(RoleService $roleService, ResetPasswordService $resetPasswordService )
    {
        $this->adminModel = new Admin();

        $this->roleService = $roleService;

        $this->resetPasswordService = $resetPasswordService;

    }

    public function getAdminByEmail(string $email): ?Model
    {
        try {
            return $this->adminModel->where('email', $email)->first();
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

    }

    public function getAdminsRoles(): ?\Illuminate\Support\Collection
    {
        try {
            return $this->roleService->setBuilder(Role::whereGuardName('web-admin'))->list();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function updateAdmin(Request $request, $admin): ?bool
    {
        try {
            $data = $request->except('password', 'role');
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $admin->syncRoles($request->role);

            return $admin->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function addAdmin(Request $request): ?Model
    {
        try {
            $data = $request->except('invite', 'password', 'role');
            $data['password'] = Hash::make($request->password);
            $admin = $this->adminModel->create($data);
            $admin->syncRoles($request->role);
            if ($request->invite) {
                $token = $this->resetPasswordService->createResetPasswordToken($admin->email);
                dispatch(new SendSetPasswordEmailJob($admin->name, $admin->email, $token, 'admin'));   
            }
            return $admin;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function deleteAdmin(Admin $admin): ?bool
    {
        try {
            return $admin->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function search(Request $request): ?AdminServiceContract
    {
        try {
            $this->adminModel = $this->adminModel;
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function getCollection(): ?Model
    {
        try {
            return $this->adminModel;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function getAuthAdmin(string $guard): ?Model
    {
        try {
            return auth($guard)->user();
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

    }

    public function passwordReset(Admin $admin, $password): ?Model
    {
        try {
            $admin->update(
                [
                    'password' => Hash::make($password),
                ]
            );
            return $admin->fresh();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function resetPassword(Request $request, $admin): ?bool
    {
        try {

            $data = [];

            $data['password'] = Hash::make($request->password);

            return $admin->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

}
