<?php

namespace App\Domains\Driver\v1\Enums;

enum DriverStatusEnum: int
{
    const __default = self::UNKNOWN;

    case UNKNOWN = 0; // under review
    case UNDER_REVIEW = 1; // under review
    case PENDING = 2; // pending
    case APPROVED = 3; // approved
    case REJECTED = 4; // rejected
}
