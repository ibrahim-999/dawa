<?php

namespace App\Domains\User\v1\Enums;

enum OrderStatusEnum: int
{
    case PENDING = 1;
    case CANCELED = 2;
    case DRIVER_ACCEPTED = 3;
    case CANCELED_AND_RETURNED = 4;
    case Delivered = 5;

}
