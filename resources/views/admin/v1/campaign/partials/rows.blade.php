@foreach($campaigns as $campaign)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">&nbsp;</label>
            </div>
        </td>
        <td class="table-user">
            {{$campaign->id}}
        </td>
        <td class="table-user">
            {{$campaign->title}}
        </td>
        <td>
            {{$campaign->description}}
        </td>
        <td>
            {{\App\Domains\Campaigns\v1\Enums\CampaignUserTypeEnum::from((int)$campaign->user_type)->name}}
        </td>
        <td>
            {{\App\Domains\Campaigns\v1\Enums\CampaignTypeEnum::from((int)$campaign->type)->name}}
        </td>
        <td>
            @if($campaign->is_active)
                <span class="badge bg-soft-success text-success">{{__('labels.active')}}</span>

            @else
                <span class="badge bg-soft-danger text-danger">{{__('labels.inactive')}}</span>

            @endif
        </td>
        <td>
            {{$campaign->created_at}}
        </td>
        <td>
            {{$campaign->updated_at}}
        </td>
        <td>
            @include('admin.v1.campaign.partials.action-btns')
        </td>
    </tr>
@endforeach
