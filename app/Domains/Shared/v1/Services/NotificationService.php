<?php

namespace App\Domains\Shared\v1\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class NotificationService
{
    public function paginate_simple(int $itemsPerPage): array
    {
        try {
            $user = getAuthUser();
            // dd($user);
            return ['notifications' => $user->notifications()->orderBy('created_at', 'desc')->simplePaginate($itemsPerPage),'unread_notifications_count' => $user->unreadNotifications()->count()];
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            $user = getAuthUser();

            $notification = $user->notifications()->where($key, $value)->first();
            if(!$notification)
            {
                return null;
            }
            ($notification) ? $notification->markAsRead() : '' ;
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
}
