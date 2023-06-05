<?php

namespace App\Domains\Shared\v1\Traits;

use App\Models\FirebaseDeviceToken;

trait FirebaseDeviceTokensTrait
{
    /**
     * Specifies the user's FCM tokens.
     *
     * @return string|array
     */
    public function getDeviceTokens()
    {
        return $this->firebaseTokens()->get()->pluck('device_token')->toArray();
    }

    /**
     * Specifies the user's FCM tokens.
     */
    public function firebaseTokens()
    {
        return $this->morphMany(FirebaseDeviceToken::class, 'notifiable');
    }
}
