<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Shared\v1\Services\NotificationService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Shared\NotificationResource;
use Illuminate\Http\Request;


class NotificationController extends ApiController
{
    private NotificationService $notificationService;

    public function __construct(
        NotificationService $notificationService,
    )
    {
        $this->notificationService = $notificationService;
    }

    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 10 ;

        $result = $this->notificationService->paginate_simple($page_size);

        $data = NotificationResource::collection($result['notifications'])->resource->toArray();

        $data_array=['notifications' => $data['data']];

        unset($data['data']);

        $data['unread_notifications_count'] = $result['unread_notifications_count'];

        return $this->successShowPaginationResponse($data_array, $data, 'notifications_list');
    }

    public function show($id)
    {
        $notification = $this->notificationService->find('id', $id);
        if (!$notification) {
            return $this->failResourceNotFoundMessage('notification_item');
        }
        $data = NotificationResource::make($notification);

        return $this->successShowDataResponse($data, 'categories_item');
    }

    public function markAllSeen()
    {
        $this->notificationService->markAllSeen();

        return $this->successUpdateNoContentResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notification = $this->notificationService->find('id', $id);

        if (!$notification) {
            return $this->failResourceNotFoundMessage('notification');
        }

        $deleted = $this->notificationService->delete($notification);

        if (!$deleted) {
            return $this->failDeleteMessage();
        }

        return $this->successDeleteMessage();
    }
}
