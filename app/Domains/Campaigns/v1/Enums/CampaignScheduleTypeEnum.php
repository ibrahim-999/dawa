<?php

namespace App\Domains\Campaigns\v1\Enums;

enum CampaignScheduleTypeEnum: int
{
    case DAILY = 1;
    case WEEKLY = 2;
}
