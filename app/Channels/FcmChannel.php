<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class FcmChannel
{
    public function send ($notifiable, Notification $notification) {
        $message = $notification->toFcm($notifiable);
    }
}