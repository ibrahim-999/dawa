<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Shared\v1\Enums\HttpRequestStatusEnum;
use App\Domains\Shared\v1\Services\NotificationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    private NotificationService $notificationService;


    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function fetchNotifications()
    {
        $notifications = $this->notificationService->paginate_simple(10);

        return response()->json($notifications, HttpRequestStatusEnum::STATUS_OK->value);
    }
}
