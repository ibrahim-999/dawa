<?php

namespace App\Observers;

use App\Jobs\SendNewOrderCreatedNotificationJob;
use App\Jobs\SendOrderCreatedSuccessfullyJob;
use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use App\Notifications\NewOrderNotification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $this->sendNotification($order);
    }

    private function sendNotification(Order $order)
    {
        $vendors = Vendor::all();
        $admins = Admin::all();
        $user = $order->user;
        dispatch(new SendOrderCreatedSuccessfullyJob($user, $order));   
        dispatch(new SendNewOrderCreatedNotificationJob($admins, $vendors, $order));   
    }
}
