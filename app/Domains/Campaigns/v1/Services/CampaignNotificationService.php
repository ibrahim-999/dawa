<?php

namespace App\Domains\Campaigns\v1\Services;

use App\Domains\Campaigns\v1\Enums\CampaignSentTypeEnum;
use App\Domains\Campaigns\v1\Enums\CampaignUserTypeEnum;
use App\Jobs\SendNotificationCenterJob;
use App\Models\CampaignNotification;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CampaignNotificationService
{
    private Model|Builder $campaignNotificationModel;

    public function __construct()
    {
        $this->campaignNotificationModel = new CampaignNotification();
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

    public function setBuilder(Model|Builder $query)
    {
        try {
            $this->campaignNotificationModel = $query;

            return $this;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function notifications_list($itemsPerPage)
    {
        try {
            $notifications = $this->campaignNotificationModel->orderBy('created_at', 'desc')
                ->simplePaginate($itemsPerPage);
            return $notifications;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function add(Request $request): ?Model
    {
        try {
            $notification = $this->campaignNotificationModel->create($request->all());


            if ($request->user_type == CampaignUserTypeEnum::USERS->value) {
                $customers = User::whereIn('id', $request->user_id)->get();

                $vendors = [];

                if ($customers->count()) {
                    foreach ($customers as $customer) {
                        $customer->campaignable()->create([
                            'title' => $notification->title,
                            'description' => $notification->description,
                            'subject' => $notification->subject,
                            'notification_type' => $request->type,
                        ]);

                    }

                }

            } elseif ($request->user_type == CampaignUserTypeEnum::VENDORS->value) {

                $customers = [];

                $vendors = Vendor::whereIn('id', $request->vendor_id)->get();

                if ($vendors->count()) {
                    foreach ($vendors as $item) {
                        $item->campaignable()->create([
                            'title' => $notification->title,
                            'description' => $notification->description,
                            'subject' => $notification->subject,
                            'notification_type' => $request->type,

                        ]);
                    }
                }

            } else {
                $customers = User::all();

                $vendors = Vendor::all();
            }
            if ($request->sent_type == CampaignSentTypeEnum::NOW->value) {
                SendNotificationCenterJob::dispatch($customers, $vendors, $notification);
            }
            return $notification;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function update(Request $request)
    {
        try {
            $notification = $this->campaignNotificationModel->update($request->all());

            if ($request->user_type == 'users') {
                $customers = User::whereIn('id', $request->user_id)->get();

                $vendors = [];
                if ($request->sent_type == 'schedule') {
                    if ($customers->count()) {
                        foreach ($customers as $customer) {
                            $customer->campaignable()->update([
                                'title' => $notification->title,
                                'description' => $notification->description,
                                'subject' => $notification->subject,
                                'notification_type' => $request->type,
                            ]);
                        }
                    }

                }

            } elseif ($request->user_type == 'vendors') {

                $customers = [];

                $vendors = Vendor::whereIn('id', $request->vendor_id)->get();

                if ($request->sent_type == 'schedule') {
                    $this->campaignNotificationModel->users()->detach();
                    if ($vendors->count()) {
                        foreach ($vendors as $vendor) {
                            $vendor->campaignable()->update([
                                'title' => $notification->title,
                                'description' => $notification->description,
                                'subject' => $notification->subject,
                                'notification_type' => $request->type,
                            ]);
                        }
                    }
                }

            } else {
                $customers = User::all();

                $vendors = Vendor::all();
            }

            if ($request->sent_type == 'now') {
                SendNotificationCenterJob::dispatch($customers, $vendors, $this->campaignNotificationModel);
            }
            return $notification;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function destroy($item)
    {
        try {

            $item->users()->detach();

            return $item->users()->delete();

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
