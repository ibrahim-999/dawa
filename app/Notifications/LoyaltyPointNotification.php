<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Domains\Shared\v1\Enums\ModelEnum;
use App\Domains\Shared\v1\Enums\NotificationReasonEnum;
use App\Domains\Shared\v1\Services\FcmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoyaltyPointNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $fcmService;
    protected $action;
    protected $points;

    public function __construct($action, $points)
    {
        $this->fcmService = app()->make(FcmService::class);
        $this->action = $action;
        $this->points = $points;
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
            'title' => __ ('messages.receive_points_on_wallet_title'),
            'body' => __ ('messages.receive_points_on_wallet_body'),
            'device_tokens' => $deviceTokens,
            'data'=>[
                'model_type' => 'user',
                'model_id' => $notifiable->id,
                'reason' => NotificationReasonEnum::GainLoyaltyPoint->value
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
                'title' => __ ('messages.receive_points_on_wallet_title',[],'en'),
                'body' => __ ('messages.receive_points_on_wallet_body',[],'en'),
            ],
            'ar' => [
                'title' => __ ('messages.receive_points_on_wallet_title',[],'ar'),
                'body' => __ ('messages.receive_points_on_wallet_body',[],'ar'),
            ],

            'model_type' => 'user',
            'model_id' => $notifiable->id,
            'reason' => NotificationReasonEnum::GainLoyaltyPoint->value

    ];
}
}
