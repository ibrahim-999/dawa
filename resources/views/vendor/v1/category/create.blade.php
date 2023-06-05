@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_category')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.categories_index')}}"
                                                         url="{{route('categories.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.categories_create')}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.categories_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>


    <div class="row">
        <div class="col-md-3 card-box p-3" style=" overflow: auto;">
            <h4 class="text-dark header-title m-t-0 m-b-30">{{__('labels.categories_tree')}}</h4>

            @include('admin.v1.category.partials.tree',['categories'=>$categories_tree])
        </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
    <x-admin.v1.form.form title="{{__('forms.add_category_title')}}"
                          description="{{__('forms.add_category_description')}}"
                          url="{{route('categories.store')}}"
                          method="POST" fileable="false">
        <x-slot name="inputs">
            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="parent_id"
                                          title="{{__('labels.parent')}}">
                <x-slot name="options">
                    <option value="">{{__('labels.main_category')}}</option>
                    @foreach($categories as $id => $name)
                        <option @if(old('parent_id') == $id) selected @endif value="{{$id}}">{{$name}}</option>
                    @endforeach
                </x-slot>
            </x-admin.v1.form.select-input>

            @dd($local.'title')
            @foreach(config('translatable.locales') as $local)
                <div class="col-md-12">
                <h5>{{__('labels.language')}}-{{ucfirst($local)}}</h5>
                </div>

            <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend="" value="{{old($local.'[title]')}}" size="col-md-12" name="{{$local}}[title]"
                                        title="{{__('labels.title',['local'=>$local])}}"
                                        placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
            <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[description]')}}" length="500" rows="4" size="col-md-12"
                                             name="{{$local}}[description]" title="{{__('labels.description')}}"
                                             placeholder="{{__('placeholders.description')}}"/>
            @endforeach

        </x-slot>
        <x-slot name="buttons">
            <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit" title="{{__('labels.create')}}"/>
        </x-slot>
    </x-admin.v1.form.form>
            </div>
        </div>
    </div>
    </div>
@endsection
