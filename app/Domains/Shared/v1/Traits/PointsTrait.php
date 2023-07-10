<?php

namespace App\Domains\Shared\v1\Traits;

use App\Domains\Shared\v1\Enums\TransactionTypeEnum;
use App\Domains\Shared\v1\Enums\TransactionWalletsEnum;
use App\Models\FirebaseDeviceToken;
use App\Models\Point;
use App\Models\Transaction;

trait PointsTrait
{
    /**
     * Specifies the user's point.
     *
     * @return string|array
     */
    public function point()
    {
        return $this->morphOne(Point::class, 'pointable');
    }

    /**
     * Specifies the user's point.
     *
     * @return string|array
     */
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'userable');
    }

    /**
     * Specifies the user's point.
     *
     * @return string|array
     */
    public function getWalletPointsAttribute()
    {
        $deposited = $this->transactions()->where('wallet',TransactionWalletsEnum::Loyalty->value)->where('type',TransactionTypeEnum::Deposit->value)->sum('value');
        $withdraw = $this->transactions()->where('wallet',TransactionWalletsEnum::Loyalty->value)->where('type',TransactionTypeEnum::Withdraw->value)->sum('value');
        return $deposited - $withdraw;
    }

}
