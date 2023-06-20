<?php

namespace App\Domains\Campaigns\v1\Enums;

enum CampaignUserTypeEnum: int
{
    case ALL = 1;
    case USERS = 2;
    case VENDORS = 3;
}
