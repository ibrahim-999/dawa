<?php

namespace App\Console\Commands;

use App\Domains\Campaigns\v1\Enums\CampaignScheduleTypeEnum;
use App\Domains\Campaigns\v1\Enums\CampaignUserTypeEnum;
use App\Jobs\SendCampaignNotificationJob;
use App\Models\CampNotification;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
    public function handle()
    {
        $customers = User::all();

        $vendors = Vendor::all();


        $dailyCampNotifications = CampNotification::where('schedule_type', CampaignScheduleTypeEnum::DAILY->value)
            ->where('is_active', 1)
            ->get();
        $weeklyCampNotifications = CampNotification::where('schedule_type', CampaignScheduleTypeEnum::WEEKLY->value)
            ->where('is_active', 1)
            ->get();


        if ($dailyCampNotifications->count()) {
            foreach ($dailyCampNotifications as $dailyCampNotification) {
                $vendors_ids = $dailyCampNotification->campaigns()->where('campaignable_type', 'App\Models\Vendor')->pluck('campaignable_id')->toArray();
                $customers_ids = $dailyCampNotification->campaigns()->where('campaignable_type', 'App\Models\User')->pluck('campaignable_id')->toArray();
                $customers_data = Vendor::whereIn('id', $customers_ids ?? [])->get();
                $vendors_data = Vendor::whereIn('id', $vendors_ids ?? [])->get();

                Log::info($dailyCampNotification->user_type);
                if ($dailyCampNotification->user_type != CampaignUserTypeEnum::ALL->value) {
                    $customers = $dailyCampNotification->user_type == 2 ? $customers_data : [];
                    $vendors = $dailyCampNotification->user_type == 3 ? $vendors_data : [];
                }

                if (Carbon::parse($dailyCampNotification->start_date)->gte(Carbon::now()) && Carbon::parse($dailyCampNotification->end_date)->lte(Carbon::now())) {
                    SendCampaignNotificationJob::dispatch($customers, $vendors, $dailyCampNotification);
                }
            }
        }

        if ($weeklyCampNotifications->count()) {
            foreach ($weeklyCampNotifications as $weeklyCampNotification) {
                if ($weeklyCampNotification->user_type != CampaignUserTypeEnum::ALL->value) {
                    $customers = $weeklyCampNotification->user_type == 2 ? $customers_data : [];
                    $vendors = $weeklyCampNotification->user_type == 3 ? $vendors_data : [];
                }
                if (date('D') == __('text.days_' . $weeklyCampNotification->days_of_week)) {
                    if (Carbon::parse($weeklyCampNotification->start_date)->gte(Carbon::now()) && Carbon::parse($weeklyCampNotification->end_date)->lte(Carbon::now())) {
                        SendCampaignNotificationJob::dispatch($customers, $vendors, $weeklyCampNotification);
                    }
                }
            }
        }
    }
}
