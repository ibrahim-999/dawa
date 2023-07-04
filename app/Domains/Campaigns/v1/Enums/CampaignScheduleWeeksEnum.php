<?php

namespace App\Domains\Campaigns\v1\Enums;

enum CampaignScheduleWeeksEnum: int
{
    case SATURDAY = 1;
    case SUNDAY = 2;
    case MONDAY = 3;
    case TUESDAY = 4;
    case WEDNESDAY = 5;
    case THURSDAY = 6;
    case FRIDAY = 7;
}
