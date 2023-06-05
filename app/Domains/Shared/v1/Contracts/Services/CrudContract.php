<?php

namespace App\Domains\Shared\v1\Contracts\Services;
use App\Domains\Vendor\v1\Contracts\Services\VendorServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * crud operations to be implemented on each service
 */
interface CrudContract
{
    /**
     * @param Request $request
     * @return Model|null
     */
    public function add(Request $request) :?Model;

    /**
     * @param string $key
     * @param string $value
     * @return Model|null
     */
    public function find(string$key,string$value) :?Model;

    /**
     * @param Request $request
     * @return bool
     */
    public function update(Request $request) :bool;

    /**
     * @param Model $item
     * @return bool
     */
    public function delete(Model $item) :bool;

    /**
     * @param Model|Builder $query
     * @return VendorServiceContract
     */
    public function setBuilder(Model|Builder $query):CrudContract;

}
