
<x-admin.v1.buttons.modal-btn class="btn action-icon" target="editValue-{{$value->id}}">
    <x-slot name="icon">
        <i class="mdi mdi-square-edit-outline"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.form.ajax-form-with-btn
            classes=""
            id="editValue-{{$value->id}}"
            header="{{__('texts.edit_value_header')}}"
            fileable="false"
            url="{{route('attribute_values.update',$value->id)}}"
            method="PATCH" fileable="false"
        >
            <x-slot name="inputs">
                <x-admin.v1.form.text-input errorName="" prepend="" value="{{$value->code}}" size="col-md-12"
                                            name="code"
                                            title="{{__('labels.code')}}"
                                            placeholder="{{__('placeholders.code')}}"/>
                @foreach(config('translatable.locales') as $local)
                    <x-admin.v1.form.text-input errorName="{{$local}}.value_title" prepend="" value="{{$value->translate($local)->name}}" size="col-md-12"
                                                name="{{$local}}[value_title]"
                                                title="{{__('labels.value_title',['local'=>$local])}}"
                                                placeholder="{{__('placeholders.value_title',['local'=>$local])}}"/>
                @endforeach

            </x-slot>
            <x-slot name="actionBtns">
            </x-slot>
        </x-admin.v1.modals.form.ajax-form-with-btn>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
