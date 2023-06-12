<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Admin\v1\Services\AdminAccessService;
use App\Domains\Driver\v1\Services\DriverService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreDriverRequest;
use App\Http\Requests\Admin\AdminUpdateDriverRequest;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DriverController extends Controller
{

    private AdminAccessService $accessService;
    private DriverService $driverService;

    public function __construct(
        AdminAccessService $accessService,
        DriverService       $driverService,
    )
    {
        $this->accessService = $accessService;
        $this->driverService = $driverService;

        $this->middleware('permission:create_drivers', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_drivers', ['only' => ['show']]);
        $this->middleware('permission:update_drivers', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_drivers', ['only' => ['index']]);
        $this->middleware('permission:delete_drivers', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $drivers = $this->driverService->search($request)->getCollection()->paginate($itemsPerPage);
        return view('admin/v1/driver/index', compact('drivers'));
    }

    public function create()
    {
        return view('admin/v1/driver/create');
    }

    public function store(AdminStoreDriverRequest $request)
    {
        $user = $this->driverService->addDriverByAdmin($request);
        if ($user) {
            return Redirect::route('drivers.index')->with('success', __('messages.driver_created_successfully'));
        } else {
            return Redirect::back();
        }

    }


    public function destroy(Driver $driver)
    {
        $deleted = $this->driverService->deleteDriver($driver);
        if ($deleted) {
            return Redirect::route('drivers.index')->with('success', __('messages.driver_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('drivers.index')->with('success', __('messages.driver_deleted_successfully'));
    }

    public function edit(Driver $driver)
    {
        return view('admin/v1/driver/edit', compact('driver'));
    }

    public function update(Driver $driver, AdminUpdateDriverRequest $request)
    {
        $updated = $this->driverService->updateDriverByAdmin($request, $driver);
        if ($updated) {
            return Redirect::route('drivers.index')->with('success', __('messages.driver_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

    public function show(Driver $driver)
    {
        return view('admin/v1/driver/show', compact('driver'));
    }

    public function warning(Driver $driver, Request $request)
    {
        $updated = $this->driverService->warningDriverByAdmin($request, $driver);
        return Redirect::back();
    }
}
