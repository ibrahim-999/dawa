<?php

namespace App\Domains\Shared\v1\Enums;

enum SettingGroupEnum: int
{
    case GENERAL = 1 ;
    case LOYALTY_POINTS = 2 ;
    case LOYALTY_POINT_ACTIONS = 3 ;
}
