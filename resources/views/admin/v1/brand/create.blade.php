@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_brand')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.brands_index')}}"
                                                         url="{{route('brands.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.brands_create')}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.brands_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>



    <div class="card">
        <div class="card-body">
            <x-admin.v1.form.form title="{{__('forms.add_brand_title')}}"
                                  description="{{__('forms.add_brand_description')}}"
                                  url="{{route('brands.store')}}"
                                  method="POST" fileable="true">
                <x-slot name="inputs">
                    <div class="row">
                    @foreach(config('translatable.locales') as $local)
                        <div class="col-md-12">
                            <h5>{{__('labels.language')}}-{{ucfirst($local)}}</h5>
                        </div>

                            <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend="" value="{{old($local.'[title]')}}" size="col-md-6"
                            name="{{$local}}[title]"
                            title="{{__('labels.title',['local'=>$local])}}"
                            placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                            <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[description]')}}" length="500"
                                                            rows="4" size="col-md-6"
                                                            name="{{$local}}[description]"
                                                            title="{{__('labels.description',['local'=>$local])}}"
                                                            placeholder="{{__('placeholders.description')}}"/>

                    @endforeach
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

@endsection
