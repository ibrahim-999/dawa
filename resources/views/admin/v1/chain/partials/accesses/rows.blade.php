@foreach($accesses as $access)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">&nbsp;</label>
            </div>
        </td>
        <td>
            {{$access->access_id}}
        </td>
        <td class="table-user">
            <img src="{{asset('admin-panel-assets/v1/images/companies/amazon.png')}}" alt="table-user"
                 class="mr-2 rounded-circle">
            <a href="javascript:void(0);" class="text-body font-weight-semibold">{{$access->name}}</a>
        </td>
        <td>
            {{$access->email}}
        </td>

        <td>
            @include('admin.v1.chain.partials.accesses.action-btns')
        </td>
    </tr>
@endforeach
