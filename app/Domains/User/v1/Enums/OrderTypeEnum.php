<?php

namespace App\Domains\User\v1\Enums;

enum OrderTypeEnum: int
{
    case PRODUCTS = 1;
    case PRESCRIPTION = 2;
    case SEARCH = 3;
    case OFFER = 4;
}
