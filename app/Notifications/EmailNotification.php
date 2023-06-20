<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $notification;

    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Get the campaign's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the campaign.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->notification->subject_en)
            // ->markdown('emails.new-order-created', ['body' => __ ('messages.new_order_created_mail_content')]);
            ->markdown('emails.new-campaign', ['campaign' => ($this->notification)->refresh(),
                'body' => $this->notification->description]);
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
