<?php

namespace App\Domains\User\v1\Enums;

enum DeliveryTypeEnum: int
{
    case EXPRESS = 1;

    case SCHEDULE = 2;
}
