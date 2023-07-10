<?php

namespace App\Domains\Shared\v1\Enums;

enum TransactionTypeEnum: int
{
    case Deposit = 1;
    case Withdraw = 2;
}
