<?php

namespace App\Jobs;

use App\Domains\Campaigns\v1\Enums\CampaignTypeEnum;
use App\Notifications\CampaignFcmNotification;
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

        if (request()->type == CampaignTypeEnum::FCM->value) {

            Notification::send($this->customers, new CampaignFcmNotification($this->notification));

            Notification::send($this->vendors, new CampaignFcmNotification($this->notification));

        } elseif (request()->type == CampaignTypeEnum::EMAIL->value) {
            Notification::send($this->customers, new EmailNotification($this->notification));

            Notification::send($this->vendors, new EmailNotification($this->notification));

        }elseif (request()->type == CampaignTypeEnum::SMS->value) {
            //
        }  else {
            Notification::send($this->customers, new CampaignFcmNotification($this->notification));

            Notification::send($this->vendors, new CampaignFcmNotification($this->notification));

            Notification::send($this->customers, new EmailNotification($this->notification));

            Notification::send($this->vendors, new EmailNotification($this->notification));

        }

    }
}
