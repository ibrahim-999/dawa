<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Shared\v1\Enums\TransactionWalletsEnum;
use App\Domains\Shared\v1\Services\NotificationService;
use App\Domains\Shared\v1\Services\TransactionService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Shared\NotificationResource;
use App\Http\Resources\Shared\PointTransactionResource;
use Illuminate\Http\Request;


class PointTransactionController extends ApiController
{
    private TransactionService $transactionService;

    public function __construct(
        TransactionService $transactionService,
    )
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        $page_size=$request->page_size ?? 10 ;

        $request->wallet_type = TransactionWalletsEnum::Loyalty->value;

        $transactions = $this->transactionService
            ->search($request)
            ->sort('id','DESC')
            ->paginate_simple($page_size);

        $data= PointTransactionResource::collection($transactions)->resource->toArray();

        $data_array = ['transactions' => $data['data']];

        unset($data['data']);

        $data['statistics'] = [
            'total_points' => $this->transactionService->getUserPoints()
        ];

        return $this->successShowPaginationResponse($data_array,$data, 'transactions');
    }
    public function main(Request $request)
    {
        $page_size=$request->page_size ?? 10 ;
        $request->wallet_type = TransactionWalletsEnum::Loyalty->value;
        $deposit_points =PointTransactionResource::collection($this->transactionService->reset()->deposit_points()->take(3));
        $withdraw_points =PointTransactionResource::collection($this->transactionService->reset()->withdraw_points()->take(3));
        $data_array = ['deposit_points'=>$deposit_points,'withdraw_points'=>$withdraw_points];
        $data['statistics'] = [
            'total_points' => $this->transactionService->reset()->getUserPoints()
        ];
        return $this->successShowPaginationResponse($data_array,$data, 'transactions');
    }
}
