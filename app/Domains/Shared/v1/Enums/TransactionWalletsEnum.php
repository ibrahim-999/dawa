<?php

namespace App\Domains\Shared\v1\Enums;

enum TransactionWalletsEnum: int
{
    case Loyalty = 1;
    case Money = 2;
}
