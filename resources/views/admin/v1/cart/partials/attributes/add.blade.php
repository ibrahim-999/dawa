<x-admin.v1.buttons.modal-btn class="btn btn-sm btn-success" target="addAttribute-{{$product->id}}">
    <x-slot name="icon">
        {{__('labels.add')}}
        <i class="mdi mdi-account-plus"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.form.ajax-form-with-btn
            classes=""
            id="addAttribute-{{$product->id}}"
            header="{{__('texts.add_attribute_header')}}"
            fileable="false"
            url="{{route('attributes.store',$product->id)}}"
            method="POST" fileable="false"
        >
            <x-slot name="inputs">
                @foreach(config('translatable.locales') as $local)
                    <x-admin.v1.form.text-input errorName="{{$local}}.attribute_title" prepend="" value="{{old($local.'[attribute_title]')}}" size="col-md-12"
                                                name="{{$local}}[attribute_title]"
                                                title="{{__('labels.attribute_title',['local'=>$local])}}"
                                                placeholder="{{__('placeholders.attribute_title',['local'=>$local])}}"/>
                @endforeach


{{--                    <x-admin.v1.form.text-input errorName="" prepend="" value="" size="col-md-12"--}}
{{--                                                name="values"--}}
{{--                                                title="values"--}}
{{--                                                placeholder="separated by ','"/>--}}
            </x-slot>
            <x-slot name="actionBtns">
            </x-slot>
        </x-admin.v1.modals.form.ajax-form-with-btn>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
