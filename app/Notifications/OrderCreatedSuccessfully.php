<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Domains\Shared\v1\Enums\ModelEnum;
use App\Domains\Shared\v1\Services\FcmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedSuccessfully extends Notification implements ShouldQueue
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
        return ['database', FcmChannel::class,'mail'];
    }

    /**
     * Get the voice representation of the notification.
     */
    public function toFcm(object $notifiable)
    {
        $deviceTokens = $notifiable->getDeviceTokens();

        $data = [
            'title' => 'new order',
            'body' => 'new order created',
            'device_tokens' => $deviceTokens
        ];

        $this->fcmService->send($data);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('dawafast order')
            ->markdown('emails.order-created-success', ['body' => 'order created successfully']);
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
                'title' => 'new order',
                'body' => 'new order created'
            ],
            'ar' => [
                'title' => 'طلب جديد',
                'body' => 'لديك طلب جديد'
            ],

            'model_type' => 'order',
            'model_id' => $this->order->id 
        ];
    }
}
