<?php

namespace App\Jobs;

use App\Notifications\BroadcastNotification;
use App\Notifications\EmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendNotificationCenterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $customers, private $vendors, private $notification)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        if (request()->type == 'broadcast') {

            Notification::send($this->customers, new BroadcastNotification($this->notification));

            Notification::send($this->vendors, new BroadcastNotification($this->notification));

        } elseif (request()->type == 'email') {
            Notification::send($this->customers, new EmailNotification($this->notification));

            Notification::send($this->vendors, new EmailNotification($this->notification));

        }elseif (request()->type == 'sms') {
            //
        }  else {
            Notification::send($this->customers, new BroadcastNotification($this->notification));

            Notification::send($this->vendors, new BroadcastNotification($this->notification));

            Notification::send($this->customers, new EmailNotification($this->notification));

            Notification::send($this->vendors, new EmailNotification($this->notification));

        }

    }
}
