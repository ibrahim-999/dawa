<x-admin.v1.buttons.modal-btn class="btn btn-sm btn-success" target="addValue-{{$attribute->id}}">
    <x-slot name="icon">
        {{__('labels.add')}}
        <i class="mdi mdi-account-plus"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.form.ajax-form-with-btn
            classes=""
            id="addValue-{{$attribute->id}}"
            header="{{__('texts.add_value_header')}}"
            fileable="false"
            url="{{route('attribute_values.store',$attribute->id)}}"
            method="POST" fileable="false"
        >
            <x-slot name="inputs">
                <x-admin.v1.form.text-input errorName="" prepend="" value="{{old('code')}}" size="col-md-12"
                                            name="code"
                                            title="{{__('labels.code')}}"
                                            placeholder="{{__('placeholders.code')}}"/>

                @foreach(config('translatable.locales') as $local)
                    <x-admin.v1.form.text-input errorName="{{$local}}.value_title" prepend="" value="{{old($local.'[value_title]')}}" size="col-md-12"
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
