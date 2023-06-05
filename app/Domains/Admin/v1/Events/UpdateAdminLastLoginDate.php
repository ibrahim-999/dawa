<?php

namespace App\Domains\Admin\v1\Events;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateAdminLastLoginDate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        try {
            $admin = $event->user;
            $admin->last_login_at = Carbon::now()->toDateTimeString();
            $admin->last_login_ip_address = request()->getClientIp();
            $admin->save();
        } catch (\Throwable $th) {
            report($th);
        }
    }
}
