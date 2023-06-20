<?php

namespace App\Http\Controllers\Web\Campaigns\v1;

use App\Domains\Campaigns\v1\Services\CampaignNotificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaigns\CampaignNotificationRequest;
use App\Models\CampaignNotification;
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

        $this->middleware('permission:create_notifications', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_notifications', ['only' => ['show']]);
        $this->middleware('permission:update_notifications', ['only' => ['edit', 'update']]);
        $this->middleware('permission:index_notifications', ['only' => ['index']]);
        $this->middleware('permission:delete_notifications', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $campaigns = $this->campaignNotificationService->notifications_list(10);

        return view('admin/v1/notification/index', compact('campaigns'));
    }

    public function create(): View
    {
        $users = User::all();

        $vendors = Vendor::all();

        return view('admin/v1/notification/create', compact('users', 'vendors'));
    }

    public function store(CampaignNotificationRequest $request)
    {
        $this->campaignNotificationService->add($request);

        return Redirect::route('campaigns.index')->with('success', __('messages.notification_created_successfully'));
    }

    public function edit(CampaignNotification $campaign)
    {
        $users = User::all();

        $vendors = Vendor::all();

        return view('admin/v1/notification/edit', compact('users', 'vendors', 'campaign'));

    }

    public function update(CampaignNotification $notification,CampaignNotificationRequest $request)
    {
        $updated = $this->campaignNotificationService->setBuilder($notification)->update($request);

        if ($updated) {
            return Redirect::route('campaigns.index')->with('success', __('messages.notification_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }
    public function destroy(CampaignNotification $notification)
    {
        $this->campaignNotificationService->destroy($notification);

        return Redirect::route('campaigns.index')->with('success', __('messages.notification_deleted_successfully'));

    }
}
