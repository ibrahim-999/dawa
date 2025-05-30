<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Domains\Shared\v1\Services\FcmService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CampaignFcmNotification extends Notification
{
    use Queueable;
    protected $fcmService;
    protected $notification;

    public function __construct($notification)
    {
        $this->fcmService = app()->make(FcmService::class);
        $this->notification = $notification;
    }

    /**
     * Get the campaign's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    /**
     * Get the voice representation of the campaign.
     */
    public function toFcm(object $notifiable)
    {
        $deviceTokens = $notifiable->getDeviceTokens();

        $data = [
            'title' => $this->notification->title,
            'body' => $this->notification->description,
            'device_tokens' => $deviceTokens
        ];

        $this->fcmService->send($data);
    }

    /**
     * Get the array representation of the campaign.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'en' => [
                'title' =>$this->notification->translate('en')->title,
                'body' => $this->notification->translate('en')->description,
            ],
            'ar' => [
                'title' => $this->notification->translate('ar')->title,
                'body' => $this->notification->translate('ar')->description,
            ],

            'model_type' => 'notificationCenter',
            'model_id' => $this->notification->id
        ];
    }
}
