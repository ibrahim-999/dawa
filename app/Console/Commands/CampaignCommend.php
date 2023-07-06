<?php

namespace App\Console\Commands;

use App\Jobs\SendCampaignNotificationJob;
use App\Models\CampNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CampaignCommend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:campaign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send campaign';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $daily_notifications = CampNotification::where('schedule_type', 1)->get();

        $weekly_notifications = CampNotification::where('schedule_type', 2)->get();

        if ($daily_notifications->count()) {
            foreach ($daily_notifications as $daily_notification) {
                if (Carbon::parse($daily_notification->start_date)->gte(Carbon::now()) && Carbon::parse($daily_notification->end_date)->lte(Carbon::now())) {
                    SendCampaignNotificationJob::dispatch($daily_notification->customers, $daily_notification->vendors, $daily_notification);
                }
            }
        }

        if ($weekly_notifications->count()) {
            foreach ($weekly_notifications as $weekly_notification) {
                if (date('D') == __('text.days_' . $weekly_notification->week_of_day)) {
                    if (Carbon::parse($weekly_notification->start_date)->gte(Carbon::now()) && Carbon::parse($weekly_notification->end_date)->lte(Carbon::now())) {
                        SendCampaignNotificationJob::dispatch($daily_notification->customers, $weekly_notification->vendors, $weekly_notification);
                    }
                }
            }
        }
    }
}
