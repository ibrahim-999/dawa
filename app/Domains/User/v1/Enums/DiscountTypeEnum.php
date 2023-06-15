<?php

namespace App\Domains\User\v1\Enums;

enum DiscountTypeEnum: int
{
    case AMOUNT = 1;
    case PRECENTAGE = 2;
}
