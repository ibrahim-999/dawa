<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Shared\v1\Services\NotificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NotificationRequest;
use App\Models\NotificationCenter;
use App\Models\NotificationsCenter;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function __construct(
        NotificationService $notificationService,
    )
    {
        $this->notificationService = $notificationService;

        $this->middleware('permission:create_notifications', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_notifications', ['only' => ['show']]);
        $this->middleware('permission:update_notifications', ['only' => ['edit', 'update']]);
        $this->middleware('permission:index_notifications', ['only' => ['index']]);
        $this->middleware('permission:delete_notifications', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $notifications = $this->notificationService->notifications_list(10);

        return view('admin/v1/notification/index', compact('notifications'));
    }

    public function create(): View
    {
        $users = User::all();

        $vendors = Vendor::all();

        return view('admin/v1/notification/create', compact('users', 'vendors'));
    }

    public function store(NotificationRequest $request)
    {
        $this->notificationService->add($request);

        return Redirect::route('notifications.index')->with('success', __('messages.category_created_successfully'));
    }

    public function edit(NotificationCenter $notification)
    {
        $users = User::all();

        $vendors = Vendor::all();

        return view('admin/v1/notification/edit', compact('users', 'vendors', 'notification'));

    }

    public function update(NotificationCenter $notification,NotificationRequest $request)
    {
        $updated = $this->notificationService->setBuilder($notification)->update($request);

        if ($updated) {
            return Redirect::route('notifications.index')->with('success', __('messages.category_created_successfully'));
        } else {
            return Redirect::back();
        }
    }
    public function destroy(NotificationCenter $notification)
    {
        $this->notificationService->destroy($notification);

        return Redirect::route('notifications.index')->with('success', __('messages.category_deleted_successfully'));

    }
}
