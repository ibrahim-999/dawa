<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Domains\Shared\v1\Enums\ModelEnum;
use App\Domains\Shared\v1\Services\FcmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $fcmService;

    public function __construct()
    {
        $this->fcmService = app()->make(FcmService::class); 
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
            'title' => 'welcome',
            'body' => 'welcome to dawafast',
            'device_tokens' => $deviceTokens
        ];

        $this->fcmService->send($data);
        // dd(($this->fcmService->send($data))->getBody()->getContents());
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('welcome')
            ->markdown('emails.welcome', ['body' => 'welcome to dawafast ' . $notifiable->name]);
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
                'title' => 'welcome',
                'body' => 'welocome to dawafast'
            ],
            'ar' => [
                'title' => 'مرحبا',
                'body' => 'مرحبا بك في دوا فاست'
            ],

            'model_type' => $this->getMdoelType(get_class($notifiable)),
            'model_id' => $notifiable->id 
        ];
    }

    public function getMdoelType($type) : string {
        $type = match($type) {
                'App\Models\User' => ModelEnum::USER->value,
                'App\Models\Driver' => ModelEnum::DRIVER->value,
                default => ModelEnum::USER->value
            };
        return $type;    
    }
}
