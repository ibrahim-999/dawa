<?php

namespace App\Domains\Shared\v1\Services;

use App\Domains\Campaigns\v1\Enums\CampaignSentTypeEnum;
use App\Domains\Campaigns\v1\Enums\CampaignUserTypeEnum;
use App\Domains\Product\v1\Contracts\Services\ProductServiceContract;
use App\Domains\Shared\v1\Contracts\Services\ActivityServiceContract;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Jobs\SendCampaignNotificationJob;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityService
{

    private Model|Builder $baseModel;

    public function __construct()
    {
        $this->baseModel = new Activity();
    }

    public function search(Request $request): ?ActivityServiceContract
    {
        try {
            $this->baseModel = $this->baseModel->when($request->log_name);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function index(): Collection
    {
        try {
            return $this->baseModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function add(Request $request): ?Model
    {
        try {
            $activity = $this->baseModel->create($request->all());
            return $activity;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
