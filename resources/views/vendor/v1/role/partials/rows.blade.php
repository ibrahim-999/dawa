@foreach($roles as $role)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">&nbsp;</label>
            </div>
        </td>
        <td class="table-user">

            <a href="javascript:void(0);" class="text-body font-weight-semibold">{{$role->name}}</a>
        </td>
        <td>
            @if($role->guard_name == 'web-admin')
                <span class="badge bg-soft-success text-primary">{{__('labels.admin_role')}}</span>

            @else
                <span class="badge bg-soft-danger text-warning">{{__('labels.vendor_role')}}</span>

            @endif
        </td>
        <td>
            @if(($role->name === 'super_admin') || ($role->name === 'super_vendor'))
                ∞
            @else
                {{$role->permissions->count()}}
            @endif
        </td>
        <td>
            @if(($role->name !== 'super_admin') && ($role->name !== 'super_vendor'))
                @include('admin.v1.role.partials.action-btns')
            @endif
        </td>
    </tr>
@endforeach
