<?php

namespace App\Domains\Shared\v1\Services;

use App\Domains\Shared\v1\Enums\TransactionReasonEnum;
use App\Domains\Shared\v1\Enums\TransactionTypeEnum;
use App\Domains\Shared\v1\Enums\TransactionWalletsEnum;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\WalletTransaction;
use App\Notifications\LoyaltyPointNotification;
use Illuminate\Database\Eloquent\Model;

class PointService
{
    
    private Model $settingModel;
    private TransactionService $transactionService;

    public function __construct()
    {
        $this->settingModel = new Setting();
        $this->transactionService = new TransactionService();
    }
    
    public function getUserPoints(): int
    {
        try {
            $user = getAuthUser();

            $points = $user->wallet_points;

            return (int) $points;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function redeem($PointsRedeemed): bool
    {
        try {
            $user = getAuthUser();

            $points = (int) $user->point?->point;

            if ($PointsRedeemed > $points) {
                return false;
            }

            $user->point()->updateOrCreate([],['point' => ($points - $PointsRedeemed)]);

            return true;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function givePointToUserOnAction($user, string $action): bool
    {
        try {

            $setting = $this->settingModel->where('key', $action)->where('is_fixed',1)->first();

            if (!$setting) {
                return false;
            }
            $transaction = $this->transactionService->add([
                'wallet' => TransactionWalletsEnum::Loyalty,
                'type' => TransactionTypeEnum::Deposit,
                'reason' => TransactionReasonEnum::GainLoyaltyPoint,
                'value' => (int) $setting->fixed_value,
                'transactionable_type' => get_class($user),
                'transactionable_id' => $user->id,
                'userable_type' => get_class($user),
                'userable_id' => $user->id,
            ]);

            $user->notify((new LoyaltyPointNotification($action,(int) $setting->fixed_value)));
                        
            return true;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
