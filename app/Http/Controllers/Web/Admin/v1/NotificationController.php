<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Shared\v1\Services\NotificationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(
        NotificationService       $notificationService,
    )
    {
        $this->notificationService = $notificationService;

        $this->middleware('permission:create_notifications', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_notifications', ['only' => ['show']]);
        $this->middleware('permission:update_notifications', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_notifications', ['only' => ['index']]);
        $this->middleware('permission:delete_notifications', ['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        $notifications = $this->notificationService;
        return view('admin/v1/notification/index', compact('notifications'));
    }

    public function create()
    {
        return view('admin/v1/notification/create');
    }

}
