<?php

namespace App\Console\Commands;

use App\Jobs\SendCampaignNotificationJob;
use App\Models\CampNotification;
use App\Models\User;
use App\Models\Vendor;
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
        $customers = User::all();

        $vendors = Vendor::all();

        $daily_notifications = CampNotification::where('schedule_type', 1)->get();

        $weekly_notifications = CampNotification::where('schedule_type', 2)->get();


        if ($daily_notifications->count()) {
            foreach ($daily_notifications as $daily_notification) {
                if ($daily_notifications->user_type != 1) {
                    $customers = $daily_notification->user_type == 2 ? $daily_notification->customers : [];
                    $vendors = $daily_notification->user_type == 3 ? $daily_notification->vendors : [];
                }
                if (Carbon::parse($daily_notification->start_date)->gte(Carbon::now()) && Carbon::parse($daily_notification->end_date)->lte(Carbon::now())) {
                    SendCampaignNotificationJob::dispatch($customers, $vendors, $daily_notification);
                }
            }
        }

        if ($weekly_notifications->count()) {
            foreach ($weekly_notifications as $weekly_notification) {
                if ($weekly_notification->user_type != 1) {
                    $customers = $weekly_notification->user_type == 2 ? $weekly_notification->customers : [];
                    $vendors = $weekly_notification->user_type == 3 ? $weekly_notification->vendors : [];
                }
                if (date('D') == __('text.days_' . $weekly_notification->days_of_week)) {
                    if (Carbon::parse($weekly_notification->start_date)->gte(Carbon::now()) && Carbon::parse($weekly_notification->end_date)->lte(Carbon::now())) {
                        SendCampaignNotificationJob::dispatch($customers, $vendors, $weekly_notification);
                    }
                }
            }
        }
    }
}
