<?php

namespace App\Domains\Vendor\v1\Services;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class VendorAccessService
{
    private VendorService $vendorService;

    public function __construct(
        VendorService $vendorService,
    )
    {
        $this->vendorService = $vendorService;
    }


    public function verifyPassword(Model $vendor, $password): ?bool
    {
        try {
            return Hash::check($password, $vendor->password);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function login(Model $vendor, $request)
    {
        try {
            auth('web-vendor')->login($vendor, isset($request->remember_me));
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function logout()
    {
        try {
            auth('web-vendor')->logout();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
