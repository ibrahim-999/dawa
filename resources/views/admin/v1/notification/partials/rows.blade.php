@foreach($notifications as $notification)
    <tr>
        <td class="table-user">
            {{$notification->id}}
        </td>
        <td class="table-user">
            {{$notification->title}}
        </td>

        <td>
            {{$notification->description}}
        </td>
        <td>
            {{$notification->user_type}}
        </td>
        <td>
            {{$notification->type}}
        </td>
        <td>
            {{$notification->created_at}}
        </td>
        <td>
            {{$notification->updated_at}}
        </td>
        <td>
            @include('admin.v1.notification.partials.action-btns')
        </td>
    </tr>
@endforeach
