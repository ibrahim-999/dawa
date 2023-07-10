<?php

namespace App\Jobs;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Notifications\OrderCreatedSuccessfully;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class SendNewOrderCreatedNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $admins, private $vendors, private $order, private $drivers)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        foreach ($this->vendors as $vendor) {
            $vendor->notify((new NewOrderNotification($this->order))->delay([
                // 'mail' => now()->addMinutes(1)
            ]));
        }

        foreach ($this->admins as $admin) {
            $admin->notify((new NewOrderNotification($this->order))->delay([
                // 'mail' => now()->addMinutes(2)
            ]));
        }
        foreach ($this->drivers as $driver) {
            $driver->notify((new NewOrderNotification($this->order))->delay([
                // 'mail' => now()->addMinutes(2)
            ]));
        }
    }
}
