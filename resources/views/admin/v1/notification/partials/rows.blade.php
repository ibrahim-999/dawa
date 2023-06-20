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
            {{$campaign->user_type}}
        </td>
        <td>
            {{$campaign->type}}
        </td>
        <td>
            {{$campaign->created_at}}
        </td>
        <td>
            {{$campaign->updated_at}}
        </td>
        <td>
            @include('admin.v1.notification.partials.action-btns')
        </td>
    </tr>
@endforeach
