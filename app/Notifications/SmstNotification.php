<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Domains\Shared\v1\Services\FcmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SmstNotification extends Notification implements ShouldQueue
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
     * Get the campaign's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', FcmChannel::class,'mail'];
    }

    /**
     * Get the voice representation of the campaign.
     */
    public function toFcm(object $notifiable)
    {
        $deviceTokens = $notifiable->getDeviceTokens();

        $data = [
            'title' => __ ('messages.new_order_admin_notification_title'),
            'body' => __ ('messages.new_order_admin_created_notification_body'),
            'device_tokens' => $deviceTokens
        ];

        $this->fcmService->send($data);
    }

    /**
     * Get the mail representation of the campaign.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__ ('messages.new_order_admin_mail_subject'))
            // ->markdown('emails.new-order-created', ['body' => __ ('messages.new_order_created_mail_content')]);
            ->markdown('emails.new-order-created-admin', ['order' => ($this->order)->refresh(),'body' => __ ('messages.new_order_created_mail_content')]);
    }

    // /**
    //  * Get the array representation of the campaign.
    //  *
    //  * @return array<string, mixed>
    //  */
    public function toArray(object $notifiable): array
    {
        return [
            'en' => [
                'title' => __ ('messages.new_order_admin_notification_title',[],'en'),
                'body' => __ ('messages.new_order_admin_created_notification_body',[],'en'),
            ],
            'ar' => [
                'title' => __ ('messages.new_order_admin_notification_title',[],'ar'),
                'body' => __ ('messages.new_order_admin_created_notification_body',[],'ar'),
            ],

            'model_type' => 'order',
            'model_id' => $this->order->id
        ];
    }
}
