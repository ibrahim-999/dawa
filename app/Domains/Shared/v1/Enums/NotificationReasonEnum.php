<?php

namespace App\Domains\Shared\v1\Enums;

enum NotificationReasonEnum: int
{
    case NewOrder = 1;
    case DriverAssigned = 2;
    case ProfileApproved = 3;
    case GainLoyaltyPoint = 4;
}
