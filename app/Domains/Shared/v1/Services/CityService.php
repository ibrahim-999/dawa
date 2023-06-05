<?php

namespace App\Domains\Shared\v1\Services;

use App\Domains\Shared\v1\Contracts\Services\RoleServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Models\City;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class CityService
{
    private Model|Builder $cityModel;

    public function __construct()
    {
        $this->cityModel = new City();

    }

    public function index(): Collection
    {
        try {
            return $this->cityModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
