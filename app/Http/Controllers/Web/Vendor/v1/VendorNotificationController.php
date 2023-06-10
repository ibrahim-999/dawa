<?php

namespace App\Http\Controllers\Web\Vendor\v1;

use App\Domains\Shared\v1\Enums\HttpRequestStatusEnum;
use App\Domains\Shared\v1\Services\NotificationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class VendorNotificationController extends Controller
{
    private NotificationService $notificationService;


    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function fetchNotifications(): JsonResponse
    {
        $notifications = $this->notificationService->paginate_simple(10, 'web-vendor');

        return response()->json($notifications, HttpRequestStatusEnum::STATUS_OK->value);
    }

    public function makeRead(): JsonResponse
    {
        $this->notificationService->markAllSeen('web-vendor');

        return response()->json([], HttpRequestStatusEnum::STATUS_OK->value);
    }

}
