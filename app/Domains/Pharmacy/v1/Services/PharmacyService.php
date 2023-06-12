<?php

namespace App\Domains\Pharmacy\v1\Services;

use App\Domains\Pharmacy\v1\Contracts\Services\ChainServiceContract;
use App\Domains\Pharmacy\v1\Contracts\Services\PharmacyServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Models\Chain;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class PharmacyService implements PharmacyServiceContract, CrudContract
{
    private Model|Builder $pharmacyModel;

    public function __construct()
    {
        $this->pharmacyModel = new Pharmacy();
    }

    public function search(Request $request): ?PharmacyServiceContract
    {
        try {
            $this->pharmacyModel = $this->pharmacyModel
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
            $data = $request->validated();
            $chain = $this->pharmacyModel->create($data);
            if ($request->invite) {
                //TODO:Send Invitation mail
            }
            if ($request->vendor_id) {
               $this->grantAccess($chain,$request->vendor_id);
            }
            return $chain;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->pharmacyModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function setBuilder(Model|Builder $query):CrudContract
    {
        try {
            $this->pharmacyModel = $query;
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function update(Request $request): bool
    {
        try {
            $data = $request->validated();
            return $this->pharmacyModel->update($data);
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
            return $this->pharmacyModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->pharmacyModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function list() :\Illuminate\Support\Collection
    {
        try {
            return $this->pharmacyModel->pluck('name','id');
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function grantAccess(Model $chain , int $vendor_id) :bool
    {
        try {
            return (bool) $chain->accesses()->attach($vendor_id);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
