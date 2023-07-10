{{--delete button with modal components--}}
<x-admin.v1.buttons.modal-btn class="btn btn-sm btn-success" target="approve-{{$driver->id}}">
    <x-slot name="icon">
        {{__('labels.approve_profile')}}
        <i class="mdi mdi-thumb-up"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.actions.submit-or-cancel classes="" id="approve-{{$driver->id}}" header="{{__('texts.approve_profile_header')}}">
            <x-slot name="body">
                {{__('texts.approve_profile')}} ,{{$driver->name}}
            </x-slot>
            <x-slot name="actionBtns">
                <x-admin.v1.buttons.patch-btn btnType="btn-success waves-effect waves-light"
                                               url="{{route('drivers.approveProfile',$driver->id)}}">
                    <x-slot name="title">
                        <i class="mdi mdi-thumb-up"></i> {{__('labels.approve')}}
                    </x-slot>
                </x-admin.v1.buttons.patch-btn>
            </x-slot>
        </x-admin.v1.modals.actions.submit-or-cancel>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
