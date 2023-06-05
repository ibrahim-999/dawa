<?php

namespace App\Domains\Shared\v1\Enums;

enum ModelEnum: string
{
    case DRIVER = "driver";
    case USER = "user";
    case ORDER = "order";
    case PRODUCT = "product";
}
