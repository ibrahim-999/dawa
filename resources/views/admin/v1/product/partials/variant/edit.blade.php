<x-admin.v1.buttons.modal-btn class="btn btn-sm action-icon" target="editVariant-{{$variant->id}}">
    <x-slot name="icon">
        <i class="mdi mdi-square-edit-outline"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.form.right-ajax-form
            classes=""
            id="editVariant-{{$variant->id}}"
            header="{{__('texts.add_variant_header')}}"
            fileable="false"
            url="{{route('variants.update',$variant->id)}}"
            method="POST" fileable="true"
        >
            <x-slot name="inputs">
                @method('patch')
                @foreach(config('translatable.locales') as $local)
                    <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend="" value="{{$variant->translate($local)->title}}" size="col-md-12"
                                                name="{{$local}}[title]"
                                                title="{{__('labels.title',['local'=>$local])}}"
                                                placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                    <x-admin.v1.form.text-area-input prepend="" value="{{$variant->translate($local)->description}}" length="500"
                                                     rows="4" size="col-md-12"
                                                     name="{{$local}}[description]"
                                                     title="{{__('labels.description')}}"
                                                     placeholder="{{__('placeholders.description')}}"/>

                    <x-admin.v1.form.text-area-input prepend="" value="{{$variant->translate($local)->specifications}}" length="500"
                                                     rows="4" size="col-md-12"
                                                     name="{{$local}}[specifications]"
                                                     title="{{__('labels.specifications',['local'=>$local])}}"
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
                                        checked="{{in_array($value->id,$variant->values()->pluck('attribute_value_id')->toArray()) ? 1 : 0}}" name="values[{{$attribute->id}}]value"
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

                    <x-admin.v1.form.number-input errorName="" step="0.1" min="0.1" max="50000" value="{{ $variant->price }}" size="col-md-12"
                                                name="price"
                                                title="{{__('labels.price')}}"
                                                placeholder="{{__('labels.price')}}"/>
                    <x-admin.v1.form.number-input errorName="" step="0.1" min="0.1" max="50000" value="{{ $variant->discount_percentage }}" size="col-md-12"
                                                name="discount"
                                                title="{{__('labels.discount')}}"
                                                placeholder="{{__('labels.discount')}}"/>
                    <x-admin.v1.form.file-input  oldImage="{{ $variant->main_image }}" value="{{old('image')}}" prepend="" size="col-md-8" name="image"
                    title="{{__('labels.image')}}"
                    placeholder="{{__('placeholders.image')}}"/>
                    
                    <x-admin.v1.form.multi-file-input  oldImage="" value="{{old('images')}}" prepend="" size="col-md-6" name="images"
                    title="{{__('labels.image')}}"
                    placeholder="{{__('placeholders.images')}}"/>
                    <div class="col-2">
                        @foreach ($variant->sub_images as $image)
                        <img src="{{ $image->original_url }}" alt="{{ $image->original_url }}"
                        class="shadow" style="width: inherit">
                        @endforeach
                    </div>
                   <x-admin.v1.form.checkbox-input value="1" checked="1" size="col-md-12" name="is_active"
                    title="{{__('labels.is_active')}}"/>
            </x-slot>
            <x-slot name="actionBtns">
            </x-slot>
        </x-admin.v1.modals.form.right-ajax-form>
    </x-slot>
</x-admin.v1.buttons.modal-btn>
