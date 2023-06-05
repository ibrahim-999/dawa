@foreach($admins as $admin)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">&nbsp;</label>
            </div>
        </td>
        <td class="table-user">
            <img src="{{asset('admin-panel-assets/v1/images/users/user-2.jpg')}}" alt="table-user"
                 class="mr-2 rounded-circle">
            <a href="javascript:void(0);" class="text-body font-weight-semibold">{{$admin->name}}</a>
        </td>

        <td>
            {{$admin->email}}
        </td>
        <td>
            {{$admin->last_login_at}}
        </td>
        <td>
            {{$admin->last_login_ip_address}}
        </td>
        <td>
            <span class="badge bg-soft-success text-success">{{$admin->roles?->first()?->name}}</span>
        </td>

        <td>
            @include('admin.v1.admin.partials.action-btns')
        </td>
    </tr>
@endforeach
