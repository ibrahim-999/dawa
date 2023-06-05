
<x-admin.v1.buttons.modal-btn class="btn action-icon" target="editAttribute-{{$attribute->id}}">
    <x-slot name="icon">
        <i class="mdi mdi-square-edit-outline"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.form.ajax-form-with-btn
            classes=""
            id="editAttribute-{{$attribute->id}}"
            header="{{__('texts.edit_attribute_header')}}"
            fileable="false"
            url="{{route('attributes.update',$attribute->id)}}"
            method="PATCH" fileable="false"
        >
            <x-slot name="inputs">
                @foreach(config('translatable.locales') as $local)
                    <x-admin.v1.form.text-input errorName="{{$local}}.attribute_title" prepend="" value="{{$attribute->translate($local)->name}}" size="col-md-12"
                                                name="{{$local}}[attribute_title]"
                                                title="{{__('labels.attribute_title',['local'=>$local])}}"
                                                placeholder="{{__('placeholders.attribute_title',['local'=>$local])}}"/>
                @endforeach

            </x-slot>
            <x-slot name="actionBtns">
            </x-slot>
        </x-admin.v1.modals.form.ajax-form-with-btn>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
