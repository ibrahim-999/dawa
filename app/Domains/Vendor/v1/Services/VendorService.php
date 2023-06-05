<?php

namespace App\Domains\Vendor\v1\Services;

use App\Domains\Admin\v1\Services\ResetPasswordService;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Services\RoleService;
use App\Domains\Vendor\v1\Contracts\Services\VendorServiceContract;
use App\Jobs\SendSetPasswordEmailJob;
use App\Models\Role;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class VendorService implements VendorServiceContract, CrudContract
{
    private Model|Builder $vendorModel;
    private RoleService $roleService;
    private ResetPasswordService $resetPasswordService;

    public function __construct(RoleService $roleService, ResetPasswordService $resetPasswordService)
    {
        $this->vendorModel = new Vendor();
        $this->roleService = $roleService;
        $this->resetPasswordService = $resetPasswordService;

    }

    public function search(Request $request): ?vendorServiceContract
    {
        try {
            $this->vendorModel = $this->vendorModel
                ->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->name . '%')
                        ->orWhere('email', 'like', '%' . $request->email . '%');
                });
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function getVendorsRoles(): ?\Illuminate\Support\Collection
    {
        try {
            return $this->roleService->setBuilder(Role::whereGuardName('web-vendor'))->list();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function getAuthVendor(string $guard): ?Model
    {
        try {
            return auth($guard)->user();
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }

    }

    public function add(Request $request): ?Model
    {
        try {
            $data = $request->except('invite', 'password','role');
            $data['password'] = Hash::make($request->password);
            $vendor = $this->vendorModel->create($data);
            $vendor->syncRoles($request->role);

            if ($request->invite) {
                $token = $this->resetPasswordService->createResetPasswordToken($vendor->email);
                dispatch(new SendSetPasswordEmailJob($vendor->name, $vendor->email, $token, 'vendor'));   
            }

            return $vendor;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->vendorModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function setBuilder(Model|Builder $query): CrudContract
    {
        try {
            $this->vendorModel = $query;
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function update(Request $request): bool
    {
        try {
            $data = $request->except('password','role');
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $this->vendorModel->syncRoles($request->role);
            return $this->vendorModel->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function delete(Model $item): bool
    {
        try {
            return $item->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function index(): Collection
    {
        try {
            return $this->vendorModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->vendorModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function list(): \Illuminate\Support\Collection
    {
        try {
            return $this->vendorModel->pluck('name', 'id');
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function getSuperVendors(): CrudContract
    {
        $this->setBuilder($this->vendorModel->role('super_vendor'));
        return $this;
    }

    public function getAdminByEmail(string $email): ?Model
    {
        try {
            return $this->vendorModel->where('email', $email)->first();
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function resetPassword(Request $request, $vendor): ?bool
    {
        try {

            $data = [];

            $data['password'] = Hash::make($request->password);

            return $vendor->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
