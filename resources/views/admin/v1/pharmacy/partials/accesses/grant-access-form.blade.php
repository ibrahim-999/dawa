

<x-admin.v1.buttons.modal-btn class="btn btn-sm btn-success" target="GrantAccess-{{$pharmacy->id}}">
    <x-slot name="icon">
        {{__('labels.add')}}
        <i class="mdi mdi-account-plus"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.form.ajax-form
            classes=""
            id="GrantAccess-{{$pharmacy->id}}"
            header="{{__('texts.grant_pharmacy_access_header')}}"
            fileable="false"
            url="{{route('pharmacies.acl.grant',$pharmacy->id)}}"
            method="POST" fileable="false"
        >
            <x-slot name="inputs">
                <x-admin.v1.form.select-input multiple="0" size="col-md-12" name="vendor_id"
                                              title="{{__('labels.vendor')}}">
                    <x-slot name="options">
                        <option>Select</option>
                        @foreach($vendors as $id => $name)
                            <option @if(old('vendor_id') == $id) selected @endif value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </x-slot>
                </x-admin.v1.form.select-input>
            </x-slot>
            <x-slot name="actionBtns">
                <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit" title="{{__('labels.create')}}"/>
            </x-slot>
        </x-admin.v1.modals.form.ajax-form>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
