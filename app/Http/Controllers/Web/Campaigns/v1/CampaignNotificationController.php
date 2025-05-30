<?php

namespace App\Http\Controllers\Web\Campaigns\v1;

use App\Domains\Campaigns\v1\Services\CampaignNotificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaigns\CampaignNotificationRequest;
use App\Models\Campaignable;
use App\Models\CampNotification;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CampaignNotificationController extends Controller
{
    public function __construct(
        CampaignNotificationService $campaignNotificationService,
    )
    {
        $this->campaignNotificationService = $campaignNotificationService;

        $this->middleware('permission:create_campaigns', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_campaigns', ['only' => ['show']]);
        $this->middleware('permission:update_campaigns', ['only' => ['edit', 'update']]);
        $this->middleware('permission:index_campaigns', ['only' => ['index']]);
        $this->middleware('permission:delete_campaigns', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $campaigns = $this->campaignNotificationService->notifications_list(10);

        return view('admin/v1/campaign/index', compact('campaigns'));
    }

    public function create(): View
    {
        $users = User::all();

        $vendors = Vendor::all();

        return view('admin/v1/campaign/create', compact('users', 'vendors'));
    }

    public function store(CampaignNotificationRequest $request)
    {
        $this->campaignNotificationService->add($request);

        return Redirect::route('campaigns.index')->with('success', __('messages.campaigns_created_successfully'));
    }

    public function edit(CampNotification $campaign)
    {
        $users = User::all();

        $vendors = Vendor::all();

        $users_selected = Campaignable::where('notification_id',$campaign->id)->
        where('campaignable_type',User::class)->pluck('campaignable_id');

        $vendors_selected = Campaignable::where('notification_id',$campaign->id)->
        where('campaignable_type',Vendor::class)->pluck('campaignable_id');

        return view('admin/v1/campaign/edit', compact('users', 'vendors', 'campaign',
            'users_selected','vendors_selected'));

    }

    public function update(CampNotification $campaign,CampaignNotificationRequest $request)
    {

        $updated = $this->campaignNotificationService->setBuilder($campaign)->update($request);

        if ($updated) {
            return Redirect::route('campaigns.index')->with('success', __('messages.campaigns_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }
    public function destroy(CampNotification $campaign)
    {
        $this->campaignNotificationService->destroy($campaign);

        return Redirect::route('campaigns.index')->with('success', __('messages.campaigns_deleted_successfully'));

    }
}
