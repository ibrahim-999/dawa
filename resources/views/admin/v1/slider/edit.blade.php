@extends('admin.v1.layout')
@section('title',__('pages_title.edit_slider')."|".$slider->title)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.sliders_index')}}"
                                                         url="{{route('sliders.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.sliders_edit')}}-{{$slider->title}}"
                                                         url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.sliders_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>


    <div class="card">
        <div class="card-body">
            <x-admin.v1.form.form title="{{__('forms.edit_slider_title')}}-{{$slider->title}}"
                                  description=""
                                  url="{{route('sliders.update',$slider->id)}}"
                                  method="POST" fileable="true">
                <x-slot name="inputs">
                    @method('PATCH')
                    @foreach(config('translatable.locales') as $local)
                        <div class="col-md-12">
                            <h5>{{__('labels.language')}}-{{ucfirst($local)}}</h5>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.text-input errorName="" prepend="" value="{{$slider->translate($local)->title}}"
                                                        size="col-md-6" name="{{$local}}[title]"
                                                        title="{{__('labels.title',['local'=>$local])}}"
                                                        placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-8">
                            <label>Image:</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-2">
                            <img src="{{$slider->getFirstMediaUrl('image', 'thumbnail')}}" style="width: 100px">
                        </div>
                    </div>

                </x-slot>
                <x-slot name="buttons">
                    <x-admin.v1.buttons.regular-btn class="m-2" btnType="btn-primary" type="submit"
                                                    title="{{__('labels.update')}}"/>
                </x-slot>
            </x-admin.v1.form.form>
        </div>
    </div>

@endsection
