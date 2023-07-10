<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Shared\v1\Services\ActivityService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{

    private ActivityService $activityService;


    public function __construct(
        ActivityService       $activityService,
    )
    {
        $this->activityService = $activityService;

        $this->middleware('permission:index_activities', ['only' => ['index']]);

    }
    public function index(Request $request)
    {
        $activities = Activity::all();
        return view('admin/v1/activity/index', compact('activities'));
    }

}
