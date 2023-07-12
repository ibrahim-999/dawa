<?php

namespace App\Domains\Campaigns\v1\Services;

use App\Domains\Campaigns\v1\Enums\CampaignSentTypeEnum;
use App\Domains\Campaigns\v1\Enums\CampaignUserTypeEnum;
use App\Jobs\SendCampaignNotificationJob;
use App\Models\CampNotification;
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
        $this->campaignNotificationModel = new CampNotification();
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

            $campaign = $user->notifications()->where($key, $value)->first();
            if (!$campaign) {
                return null;
            }
            ($campaign) ? $campaign->markAsRead() : '';
            return $campaign->refresh();
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
            $days_of_week = null;
            $type = implode(',', $request->type);

            if ($request->days_of_week) {
                $days_of_week = implode(',', $request->days_of_week);
            }
            $campaign = $this->campaignNotificationModel->create($request->except('type', 'days_of_week'));

            $campaign->update([
                'type' => json_encode($type, true),
                'days_of_week' => json_encode($days_of_week, true),
                'is_active' => $request->is_active ? 1 : 0
            ]);

            if ($request->user_type == CampaignUserTypeEnum::USERS->value) {
                $customers = User::whereIn('id', $request->user_id)->get();

                $vendors = [];
                if ($customers->count()) {
                    foreach ($customers as $customer) {
                        foreach ($request->type as $item) {
                            $customer->campaignable()->create([
                                'title' => $campaign->title,
                                'description' => $campaign->description,
                                'subject' => $campaign->subject,
                                'notification_type' => $item,
                                'notification_id' => $campaign->id,
                            ]);
                        }
                    }
                }

            } elseif ($request->user_type == CampaignUserTypeEnum::VENDORS->value) {

                $customers = [];

                $vendors = Vendor::whereIn('id', $request->vendor_id)->get();

                if ($vendors->count()) {
                    foreach ($vendors as $item) {
                        foreach ($request->type as $item) {

                            $item->campaignable()->create([
                                'title' => $campaign->title,
                                'description' => $campaign->description,
                                'subject' => $campaign->subject,
                                'notification_type' => $request->type,
                                'notification_id' => $campaign->id,

                            ]);
                        }
                    }
                }

            } else {
                $customers = User::all();

                $vendors = Vendor::all();
            }
            if ($request->sent_type == CampaignSentTypeEnum::NOW->value) {
                SendCampaignNotificationJob::dispatch($customers, $vendors, $campaign);
            }
            return $campaign;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public
    function update(Request $request)
    {
        try {
            $days_of_week = null;
            $type = implode(',', $request->type);

            if ($request->days_of_week) {
                $days_of_week = implode(',', $request->days_of_week);
            }
            $campaign = $this->campaignNotificationModel->update($request->except('type', 'days_of_week'));

            $this->campaignNotificationModel->update([
                'is_active' => $request->is_active ? 1 : 0,
                'type' => json_encode($type, true),
                'days_of_week' => json_encode($days_of_week, true),
            ]);

            $this->campaignNotificationModel->campaigns()->delete();

            if ($request->user_type == CampaignUserTypeEnum::USERS->value) {
                $customers = User::whereIn('id', $request->user_id)->get();

                $vendors = [];
                if ($customers->count()) {
                    foreach ($customers as $customer) {
                        foreach ($request->type as $item) {
                            $customer->campaignable()->create([
                                'title' => $this->campaignNotificationModel->title,
                                'description' => $this->campaignNotificationModel->description,
                                'subject' => $this->campaignNotificationModel->subject,
                                'notification_type' => $item,
                                'notification_id' => $this->campaignNotificationModel->id,

                            ]);
                        }
                    }
                }

            } elseif ($request->user_type == CampaignUserTypeEnum::VENDORS->value) {

                $customers = [];

                $vendors = Vendor::whereIn('id', $request->vendor_id)->get();

                if ($vendors->count()) {
                    foreach ($vendors as $vendor) {
                        foreach ($request->type as $item) {
                            $vendor->campaignable()->create([
                                'title' => $this->campaignNotificationModel->title,
                                'description' => $this->campaignNotificationModel->description,
                                'subject' => $this->campaignNotificationModel->subject,
                                'notification_type' => $item,
                                'notification_id' => $this->campaignNotificationModel->id,
                            ]);
                        }
                    }
                }

            } else {
                $customers = User::all();

                $vendors = Vendor::all();
            }

            if ($request->sent_type == CampaignSentTypeEnum::NOW->value) {
                SendCampaignNotificationJob::dispatch($customers, $vendors, $this->campaignNotificationModel);
            }
            return $campaign;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public
    function destroy($item)
    {
        try {
            $item->campaigns()->delete();

            return $item->delete();

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
