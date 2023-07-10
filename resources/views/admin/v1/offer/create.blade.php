@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_offer')}}
@endsection
{{-- @php
    dd($categories,$products);
@endphp --}}
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.offers_index')}}"
                                                         url="{{route('offers.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.offers_create')}}" url="" isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.offers_index_header')}}
        </x-slot>

    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card" >
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.add_offer_title')}}"
                                      description="{{__('forms.add_offer_description')}}"
                                      url="{{route('offers.store')}}"
                                      method="POST" fileable="true">
                    <x-slot name="inputs">
                        <div class="row">
                        @foreach(config('translatable.locales') as $local)
                            <div class="col-md-12">
                                <h5>{{__('labels.language')}}-{{ucfirst($local)}}</h5>
                            </div>
                                <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend="" value="{{old($local.'.title')}}" size="col-md-6"
                                name="{{$local}}[title]"
                                title="{{__('labels.title',['local'=>$local])}}"
                                placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                                <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'.description')}}" length="500"
                                                                rows="4" size="col-md-6"
                                                                name="{{$local}}[description]"
                                                                title="{{__('labels.description',['local'=>$local])}}"
                                                                placeholder="{{__('placeholders.description')}}"/>

                        @endforeach

                    <x-admin.v1.form.date-input value="{{old('start_date')}}" prepend="" size="col-md-6" name="start_date"
                    title="{{__('labels.start_date')}}"
                    placeholder="{{__('placeholders.start_date')}}"/>


                    <x-admin.v1.form.date-input value="{{old('end_date')}}" prepend="" size="col-md-6" name="end_date"
                    title="{{__('labels.end_date')}}"
                    placeholder="{{__('placeholders.end_date')}}"/>


                    <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{old('buy_amount')}}" prepend="" size="col-md-6" name="buy_amount"
                    title="{{__('labels.buy_amount')}}"
                    placeholder="{{__('placeholders.buy_amount')}}"/>

                    <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="buyVariants[]"
                    title="{{__('labels.variants')}}">
                    <x-slot name="options">                           
                        <option >Select</option>
                        @foreach ($variants  as $variant )
                        <option @if(old('buyVariants') && in_array($variant->id,old('buyVariants'))) selected
                            @endif value="{{$variant->id}}">{{$variant->title}}</option>
                        @endforeach

                    </x-slot>
                    </x-admin.v1.form.select-input>


                    <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{old('get_amount')}}" prepend="" size="col-6" name="get_amount"
                    title="{{__('labels.get_amount')}}"
                    placeholder="{{__('placeholders.get_amount')}}"/>

                    <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="getVariants[]"
                    title="{{__('labels.getVariants')}}">
                    <x-slot name="options">                           
                        <option >Select</option>
                        @foreach ($variants  as $variant )
                        <option @if(old('getVariants') && in_array($variant->id,old('getVariants'))) selected
                            @endif value="{{$variant->id}}">{{$variant->title}}</option>
                        @endforeach

                    </x-slot>
                    </x-admin.v1.form.select-input>

                    <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="discount_type"
                    title="{{__('labels.discount_type')}}">
                    <x-slot name="options">                           
                        <option>Select</option>
                        <option @if(old('discount_type') == "1") selected
                            @endif value="{{'1'}}">{{'amount'}}</option>
                        <option @if(old('discount_type') == "2") selected
                            @endif value="{{'2'}}">{{'precentage'}}</option>        
                    </x-slot>
                    </x-admin.v1.form.select-input>

                    <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{old('discount')}}" prepend="" size="col-md-6" name="discount"
                    title="{{__('labels.discount')}}"
                    placeholder="{{__('placeholders.discount')}}"/>

                    <x-admin.v1.form.file-input  oldImage="" value="{{old('image')}}" prepend="" size="col-md-6" name="image"
                    title="{{__('labels.image')}}"
                    placeholder="{{__('placeholders.image')}}"/>
                    </div>

                    </x-slot>
                    <x-slot name="buttons">
                        <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                        title="{{__('labels.create')}}"/>
                    </x-slot>
                </x-admin.v1.form.form>
            </div>
        </div>
    </div>
@endsection