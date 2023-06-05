{{--delete button with modal components--}}
<x-admin.v1.buttons.modal-btn class="btn btn-sm action-icon" target="delete-{{$access->id}}">
    <x-slot name="icon">
        <i class="mdi mdi-delete"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.actions.submit-or-cancel classes="" id="delete-{{$access->id}}" header="{{__('texts.revoke_access_header')}}">
            <x-slot name="body">
                {{__('texts.revoke_access_body',['name'=>$access->name])}}
            </x-slot>
            <x-slot name="actionBtns">
                <x-admin.v1.buttons.delete-btn btnType="btn-danger waves-effect waves-light"
                                                  url="{{route('acl.revoke',$access->access_id)}}">
                    <x-slot name="title">
                        <i class="mdi mdi-delete"></i> {{'labels.revoke'}}
                    </x-slot>
                </x-admin.v1.buttons.delete-btn>
            </x-slot>
        </x-admin.v1.modals.actions.submit-or-cancel>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
