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

class SendCampaignNotificationJob implements ShouldQueue
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

        if ($this->notification->type == CampaignTypeEnum::FCM->value) {

            Notification::send($this->customers, new CampaignFcmNotification($this->notification));

            Notification::send($this->vendors, new CampaignFcmNotification($this->notification));

        } elseif ($this->notification->type == CampaignTypeEnum::EMAIL->value) {
            if (!empty($this->customers)) {
                foreach ($this->customers as $customer) {
                    Notification::send($customer, new EmailNotification($this->notification));
                }
            }

            if (!empty($this->vendors)) {
                foreach ($this->vendors as $vendor) {
                    Notification::send($this->$vendor, new EmailNotification($this->notification));
                }
            }

        } elseif ($this->notification->type == CampaignTypeEnum::SMS->value) {
            //
        } else {
            Notification::send($this->customers, new CampaignFcmNotification($this->notification));

            Notification::send($this->vendors, new CampaignFcmNotification($this->notification));
            if (!empty($this->customers)) {
                foreach ($this->customers as $customer) {
                    Notification::send($customer, new EmailNotification($this->notification));
                }
            }
            if (!empty($this->vendors)) {
                foreach ($this->vendors as $vendor) {
                    Notification::send($this->$vendor, new EmailNotification($this->notification));
                }
            }
        }

    }
}
