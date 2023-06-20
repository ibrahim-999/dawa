<?php

namespace App\Domains\Campaigns\v1\Enums;

enum CampaignTypeEnum : int
{
    case ALL = 1;
    case EMAIL = 2;
    case FCM = 3;
    case SMS = 4;
}
