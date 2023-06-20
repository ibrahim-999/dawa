@foreach($campaigns as $campaign)
    <tr>
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
