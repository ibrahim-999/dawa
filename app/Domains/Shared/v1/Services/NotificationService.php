<?php

namespace App\Domains\Shared\v1\Services;

use App\Jobs\SendNotificationCenterJob;
use App\Models\NotificationCenter;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NotificationService
{
    private Model|Builder $notificationCenterModel;

    public function __construct()
    {
        $this->notificationCenterModel = new NotificationCenter();
    }

    public function paginate_simple(int $itemsPerPage): array
    {
        try {
            $user = getAuthUser();
            // dd($user);
            return ['notifications' => $user->notifications()->orderBy('created_at', 'desc')->simplePaginate($itemsPerPage), 'unread_notifications_count' => $user->unreadNotifications()->count()];
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            $user = getAuthUser();

            $notification = $user->notifications()->where($key, $value)->first();
            if (!$notification) {
                return null;
            }
            ($notification) ? $notification->markAsRead() : '';
            return $notification->refresh();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function markAllSeen()
    {
        try {
            $user = auth('sanctum')->user();

            $user->unreadNotifications->markAsRead();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function delete(Model $item): bool
    {
        try {
            return $item->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function notifications_list($itemsPerPage)
    {
        try {
            $notifications = $this->notificationCenterModel->orderBy('created_at', 'desc')
                ->simplePaginate($itemsPerPage);
            return ['notifications' => $notifications];
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function add(Request $request): ?Model
    {
        try {
            $notification = $this->notificationCenterModel->create($request->all());

            if ($request->user_type == 'users') {
                $customers = User::whereIn('id', $request->user_id)->get();
            } elseif ($request->user_type == 'vendors') {
                $vendors = Vendor::whereIn('id', $request->vender_id)->get();
            } else {
                $customers = User::all();

                $vendors = Vendor::all();
            }

            SendNotificationCenterJob::dispatch($customers, $vendors, $notification);

            return $notification;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
