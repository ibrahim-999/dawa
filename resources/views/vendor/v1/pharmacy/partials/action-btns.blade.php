
<x-admin.v1.buttons.reference-btn btnType="action-icon"
                                  url="{{route('pharmacies.edit',$pharmacy->id)}}">
    <x-slot name="title">
        <i class="mdi mdi-square-edit-outline"></i>
    </x-slot>
</x-admin.v1.buttons.reference-btn>

{{--delete button with modal components--}}
<x-admin.v1.buttons.modal-btn class="btn btn-sm action-icon" target="delete-{{$pharmacy->id}}">
    <x-slot name="icon">
        <i class="mdi mdi-delete"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.actions.submit-or-cancel classes="" id="delete-{{$pharmacy->id}}" header="{{__('texts.delete_pharmacy_header')}}">
            <x-slot name="body">
                {{__('texts.delete_pharmacy_body')}} ,{{$pharmacy->name}}
            </x-slot>
            <x-slot name="actionBtns">
                <x-admin.v1.buttons.delete-btn btnType="btn-danger waves-effect waves-light"
                                                  url="{{route('pharmacies.destroy',$pharmacy->id)}}">
                    <x-slot name="title">
                        <i class="mdi mdi-delete"></i> {{'labels.delete'}}
                    </x-slot>
                </x-admin.v1.buttons.delete-btn>
            </x-slot>
        </x-admin.v1.modals.actions.submit-or-cancel>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
