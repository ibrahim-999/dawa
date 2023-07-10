<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Domains\Shared\v1\Enums\NotificationReasonEnum;
use App\Domains\Shared\v1\Services\FcmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class DriverAcceptOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $fcmService;
    protected $order;

    public function __construct($order)
    {
        $this->fcmService = app()->make(FcmService::class);
        $this->order = $order;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    /**
     * Get the voice representation of the notification.
     */
    public function toFcm(object $notifiable)
    {
        $deviceTokens = $notifiable->getDeviceTokens();

        $data = [
            'title' => __ ('messages.new_order_admin_notification_title'),
            'body' => __ ('messages.new_order_admin_created_notification_body'),
            'device_tokens' => $deviceTokens,
            'data'=>[
                'model_type' => 'order',
                'model_id' => $this->order->id,
                'reason' => NotificationReasonEnum::DriverAssigned->value
            ]
        ];

        $this->fcmService->send($data);
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @return array<string, mixed>
    //  */
    public function toArray(object $notifiable): array
    {
        return [
            'en' => [
                'title' => __ ('messages.driver_accept_order_notification_title',[],'en'),
                'body' => __ ('messages.driver_accept_order_notification_body',[],'en'),
            ],
            'ar' => [
                'title' => __ ('messages.driver_accept_order_notification_title',[],'ar'),
                'body' => __ ('messages.driver_accept_order_notification_body',[],'ar'),
            ],

            'model_type' => 'order',
            'model_id' => $this->order->id
        ];
    }
}
