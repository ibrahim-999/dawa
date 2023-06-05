<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Pharmacy\v1\Services\AclService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Access\GrantChainAccessRequest;
use App\Http\Requests\Vendor\Access\GrantPharmacyAccessRequest;
use App\Http\Requests\Vendor\Access\RevokeChainAccessRequest;
use App\Models\Chain;
use App\Models\Pharmacy;
use App\Models\role;
use App\Models\VendorAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VendorAclController extends Controller
{

    private AclService $aclService;


    public function __construct(
        AclService $aclService,
    )
    {
        $this->aclService = $aclService;

    }

    public function grantChainAccess(Chain $chain, GrantChainAccessRequest $request)
    {
        $is_granted = $this->aclService->grantChainAccess($chain, $request->vendor_id);
        if ($is_granted) {
            if ($request->ajax()) {
                return $this->successGeneralMessage(__('messages.access_granted_successfully'));
            } else {
                return Redirect::back()->with('success', __('messages.access_granted_successfully'));
            }
        } else {
            if ($request->ajax()) {
                return $this->failGeneralMessage(__('messages.access_grantee_failed'));
            } else {
                return Redirect::back()->with('success', __('messages.access_grantee_failed'));
            }
        }
    }

    public function grantPharmacyAccess(Pharmacy $pharmacy, GrantPharmacyAccessRequest $request)
    {
        $is_granted = $this->aclService->grantPharmacyAccess($pharmacy, $request->vendor_id);
        if ($is_granted) {
            if ($request->ajax()) {
                return $this->successGeneralMessage(__('messages.access_granted_successfully'));
            } else {
                return Redirect::back()->with('success', __('messages.access_granted_successfully'));
            }
        } else {
            if ($request->ajax()) {
                return $this->failGeneralMessage(__('messages.access_didnt_granted_successfully'));
            } else {
                return Redirect::back()->with('success', __('messages.access_didnt_granted_successfully'));
            }
        }
    }

    public function revokeAccess(VendorAccess $access)
    {
        $is_revoked = $this->aclService->revokeAccess($access);
        if ($is_revoked) {
            return Redirect::back()->with('success', __('messages.access_revoked_successfully'));
        } else {
            return Redirect::back();
        }
    }
}
