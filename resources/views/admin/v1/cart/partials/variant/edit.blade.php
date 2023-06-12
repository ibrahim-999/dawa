<x-admin.v1.buttons.modal-btn class="btn action-icon" target="editVariant-{{$product->id}}">
    <x-slot name="icon">
        <i class="mdi mdi-square-edit-outline"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.form.right-ajax-form
            classes=""
            id="editVariant-{{$product->id}}"
            header="{{__('texts.edit_variant_header')}}"
            fileable="false"
            url="{{route('chains.acl.grant',$product->id)}}"
            method="POST" fileable="false"
        >
            <x-slot name="inputs">
                @foreach(config('translatable.locales') as $local)
                    <x-admin.v1.form.text-input errorName="" prepend="" value="{{old($local.'[variant_title]')}}" size="col-md-12"
                                                name="{{$local}}[variant_title]"
                                                title="{{__('labels.variant_title',['local'=>$local])}}"
                                                placeholder="{{__('placeholders.variant_title',['local'=>$local])}}"/>
                @endforeach
            </x-slot>
            <x-slot name="actionBtns">
                <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit" title="{{__('labels.create')}}"/>
            </x-slot>
        </x-admin.v1.modals.form.right-ajax-form>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
