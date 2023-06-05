<?php

namespace App\Domains\User\v1\Services;

use App\Domains\User\v1\Contracts\Services\AddressServiceContract;
use App\Models\Address;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AddressService implements AddressServiceContract
{
    private Model|Builder $addressModel;

    public function __construct()
    {
        $this->addressModel = new Address();
    }


    public function add(Request $request): ?Model
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;

            $address = $this->find('place_id',$request->place_id);
            if ($address){
                $address->update($data);
            }
            else
            {
                $address = $this->addressModel->create($data);
            }

            return $address;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string|null $value): ?Model
    {
        try {
            return $this->addressModel->where('user_id', request()->user()->id)->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function update(Request $request, int $address_id): bool
    {
        try {
            $data = $request->validated();

            // TODO: if has any active cart throw exception
            return $this->addressModel->where('id', $address_id)->update($data);
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
            return $this->addressModel->where('user_id', request()->user()->id)->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function paginate_simple(int $itemsPerPage): Paginator
    {
        try {
            return $this->addressModel->where('user_id', request()->user()->id)->simplePaginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function hasActiveCart(int $address_id): bool
    {
        try {
            $address = $this->find('id', $address_id);

            // check has cart
            return false;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
