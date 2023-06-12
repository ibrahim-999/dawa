<?php

/**
 * 
 * get authenticated user driver or user
 */

use App\Models\Driver;
use App\Models\User;

if (! function_exists('getAuthUser')) {
    function getAuthUser() : Driver|User {
        $user = auth('sanctum')->user();
        if (!$user) {
            $user = auth('sanctum-driver')->user();
        }
        return $user;
    }
}