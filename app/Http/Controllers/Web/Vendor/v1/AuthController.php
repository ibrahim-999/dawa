<?php

namespace App\Http\Controllers\Web\Vendor\v1;

use App\Domains\Vendor\v1\Services\VendorAccessService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorAuthRequest;
use App\Http\Resources\Driver\AuthDriverData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    private VendorAccessService $accessService;
    private VendorService $vendorService;


    public function __construct(
        VendorAccessService $accessService,
        VendorService       $vendorService,
    )
    {
        $this->accessService = $accessService;
        $this->vendorService = $vendorService;

    }

    public function login(VendorAuthRequest $request)
    {
        $vendor = $this->vendorService->find('email',$request->email);
        $is_correct = $this->accessService->verifyPassword($vendor, $request->password);
        if ($is_correct) {
            $this->accessService->login($vendor, $request);
            return Redirect::route('vendor.dashboard')->with('success', __('messages.logged_in_success'));

        } else {
            return Redirect::back()->withErrors(['password' => __('validation.invalid_password')]);
        }

    }
    public function logout()
    {
        $vendor = $this->vendorService->getAuthVendor('web-vendor');
        if ($vendor) {
            $this->accessService->logout($vendor);
            return Redirect::route('vendor.login.view');
        }


    }

}
