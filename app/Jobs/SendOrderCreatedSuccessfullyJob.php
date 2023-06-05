<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedSuccessfully;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOrderCreatedSuccessfullyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user, private Order $order )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $userObject = $this->user;
        $userObject->notify((new OrderCreatedSuccessfully($this->order))->delay([
            // 'mail' => now()->addMinutes(2)
        ]));
    }
}
