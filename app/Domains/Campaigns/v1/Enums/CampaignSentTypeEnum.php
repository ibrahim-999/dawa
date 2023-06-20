<?php

namespace App\Domains\Campaigns\v1\Enums;

enum CampaignSentTypeEnum: int
{
    case NOW = 1;
    case SCHEDULE = 2;
}
