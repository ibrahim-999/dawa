<?php

namespace App\Domains\User\v1\Enums;

enum OrderStatusEnum: int
{
    case PENDING = 1;
    case CANCELED = 2;
}
