@include('admin.v1.product.partials.attributes.edit')

{{--delete button with modal components--}}
<x-admin.v1.buttons.modal-btn class="btn btn-sm action-icon" target="deleteAttribute-{{$attribute->id}}">
    <x-slot name="icon">
        <i class="mdi mdi-delete"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.actions.submit-or-cancel classes="" id="deleteAttribute-{{$attribute->id}}" header="{{__('texts.delete_attribute_header')}}">
            <x-slot name="body">
                {{__('texts.delete_attribute_body')}} ,{{$attribute->attribute}}
            </x-slot>
            <x-slot name="actionBtns">
                <x-admin.v1.buttons.delete-btn btnType="btn-danger waves-effect waves-light"
                                               url="{{route('attributes.destroy',$attribute->id)}}">
                    <x-slot name="title">
                        <i class="mdi mdi-delete"></i> {{'labels.delete'}}
                    </x-slot>
                </x-admin.v1.buttons.delete-btn>
            </x-slot>
        </x-admin.v1.modals.actions.submit-or-cancel>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
