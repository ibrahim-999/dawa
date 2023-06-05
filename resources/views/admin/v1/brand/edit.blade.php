@extends('admin.v1.layout')
@section('title',__('pages_title.edit_brand')."|".$brand->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.brands_index')}}"
                                                         url="{{route('brands.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.brands_edit')}}-{{$brand->name}}"
                                                         url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.brands_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>


    <div class="card">
        <div class="card-body">
            <x-admin.v1.form.form title="{{__('forms.edit_brand_title')}}-{{$brand->name}}"
                                  description="{{__('forms.edit_brand_description')}}"
                                  url="{{route('brands.update',$brand->id)}}"
                                  method="POST" fileable="false">
                <x-slot name="inputs">
                    @method('PATCH')
                    @foreach(config('translatable.locales') as $local)
                        <div class="col-md-12">
                            <h5>{{__('labels.language')}}-{{ucfirst($local)}}</h5>
                        </div>
                        <x-admin.v1.form.text-input errorName="" prepend="" value="{{$brand->translate($local)->title}}"
                                                    size="col-md-12" name="{{$local}}[title]"
                                                    title="{{__('labels.title',['local'=>$local])}}"
                                                    placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                        <x-admin.v1.form.text-area-input prepend=""
                                                         value="{{$brand->translate($local)->description}}"
                                                         length="500" rows="4" size="col-md-12"
                                                         name="{{$local}}[description]"
                                                         title="{{__('labels.description')}}"
                                                         placeholder="{{__('placeholders.description')}}"/>
                    @endforeach

                </x-slot>
                <x-slot name="buttons">
                    <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                    title="{{__('labels.update')}}"/>
                </x-slot>
            </x-admin.v1.form.form>
        </div>
    </div>

@endsection
