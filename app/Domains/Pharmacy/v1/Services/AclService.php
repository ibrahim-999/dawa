<?php

namespace App\Domains\Pharmacy\v1\Services;

use App\Domains\Pharmacy\v1\Contracts\Services\ChainServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Models\Chain;
use App\Models\Pharmacy;
use App\Models\VendorAccess;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class AclService
{
    public function grantChainAccess(Chain $chain , int $vendor_id) :bool
    {
        try {
            return (bool) $chain->accesses()->syncWithoutDetaching($vendor_id);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function grantPharmacyAccess(Pharmacy $pharmacy , int $vendor_id) :bool
    {
        try {
            return (bool) $pharmacy->accesses()->syncWithoutDetaching($vendor_id);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function revokeAccess(VendorAccess $access) :bool
    {
        try {
            return (bool)  $access->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }



}
