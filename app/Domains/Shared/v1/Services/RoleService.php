<?php

namespace App\Domains\Shared\v1\Services;

use App\Domains\Shared\v1\Contracts\Services\RoleServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class RoleService implements RoleServiceContract, CrudContract
{
    private Model|Builder $roleModel;
    private Model|Builder $permissionModel;

    public function __construct()
    {
        $this->roleModel = new Role();
        $this->permissionModel = new Permission();
    }

    public function getGuardPermissions(string $guard): ?RoleServiceContract
    {
        try {
            $this->permissionModel = $this->permissionModel
                ->where('guard_name', $guard);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function groupPermissionsByModule(): ?\Illuminate\Support\Collection
    {
        try {
            return $this->permissionModel->get()->groupBy('module_name');
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function search(Request $request): ?RoleServiceContract
    {
        try {
            $this->roleModel = $this->roleModel
                ->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->name . '%');
                });
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function add(Request $request): ?Model
    {
        try {
            $data = $request->except('permissions');
            $role = $this->roleModel->create($data);
            $role->syncPermissions($request->permissions);
            return $role;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->roleModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function setBuilder(Model|Builder $query): CrudContract
    {
        try {
            $this->roleModel = $query;
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function update(Request $request): bool
    {
        try {
            $data = $request->except('permissions');
            $this->roleModel->syncPermissions($request->permissions);
            return $this->roleModel->update($data);
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
            return $this->roleModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->roleModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function list(): \Illuminate\Support\Collection
    {
        try {
            return $this->roleModel->pluck('name', 'id');
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
