<x-admin.v1.buttons.modal-btn class="btn btn-sm btn-success" target="addVariant">
    <x-slot name="icon">
        {{__('labels.add')}}
        <i class="mdi mdi-account-plus"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.form.right-ajax-form
            classes=""
            id="addVariant"
            header="{{__('texts.add_variant_header')}}"
            fileable="false"
            url="{{route('variants.store',$product->id)}}"
            method="POST" fileable="false"
        >
            <x-slot name="inputs">
                @foreach(config('translatable.locales') as $local)
                    <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend="" value="{{old($local.'[title]')}}" size="col-md-12"
                                                name="{{$local}}[title]"
                                                title="{{__('labels.title',['local'=>$local])}}"
                                                placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                    <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[description]')}}" length="500"
                                                     rows="4" size="col-md-12"
                                                     name="{{$local}}[description]"
                                                     title="{{__('labels.description')}}"
                                                     placeholder="{{__('placeholders.description')}}"/>

                    <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[specifications]')}}" length="500"
                                                     rows="4" size="col-md-12"
                                                     name="{{$local}}[specifications]"
                                                     title="{{__('labels.specifications')}}"
                                                     placeholder="{{__('placeholders.specifications')}}"/>
                    @php
                        $ribbonColors=['blue','primary','success','info','warning','danger','pink','secondary','dark'];
                        $ribbonColor=0;
                    @endphp
                @endforeach

                    @forelse($attributes as $attribute)

                        <x-admin.v1.form.radiobtn-group ribbonColorText="{{$ribbonColors[$ribbonColor]}}"
                                                        groupName="{{$attribute->name}}" class="col-md-12">
                            <x-slot name="options">
                                @foreach($attribute->values as $value)
                                    <x-admin.v1.form.radiobtn-input
                                        class="form-group row mb-3 justify-content-end select-group-input-per "
                                        checked="@if($loop->first) 1 @endif" name="values[{{$attribute->id}}]value"
                                        value="{{$value->id}}"
                                        title="{{$value->name}}"/>
                                @endforeach
                            </x-slot>
                        </x-admin.v1.form.radiobtn-group>
                        @php
                            $ribbonColor++;
                            if ($ribbonColor > count($ribbonColors))
                                {
                                    $ribbonColor=0;
                                }
                        @endphp
                    @empty
                        <div class="col-lg-12">
                            <div class="card"
                                 style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 5px 0 rgba(0, 0, 0, 0.19) ">
                                <div class="card-body">
                                    <p class="text-center">No Attributes Yet</p>
                                </div>
                            </div>
                        </div>
                    @endforelse

                    <x-admin.v1.form.number-input errorName="" step="0.1" min="0.1" max="50000" value="" size="col-md-12"
                                                name="price"
                                                title="{{__('labels.price')}}"
                                                placeholder="{{__('labels.price')}}"/>
                    <x-admin.v1.form.number-input errorName="" step="0.1" min="0.1" max="50000" value="" size="col-md-12"
                                                name="discount"
                                                title="{{__('labels.discount')}}"
                                                placeholder="{{__('labels.discount')}}"/>
                   <x-admin.v1.form.checkbox-input value="1" checked="1" size="col-md-12" name="is_active"
                    title="{{__('labels.is_active')}}"/>
            </x-slot>
            <x-slot name="actionBtns">
            </x-slot>
        </x-admin.v1.modals.form.right-ajax-form>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
