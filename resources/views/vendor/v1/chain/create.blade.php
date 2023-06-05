@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_chain')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}" isActive="0" />
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.chains_index')}}" url="{{route('chains.index')}}" isActive="0" />
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.chains_create')}}" url="" isActive="1" />
        </x-slot>
        <x-slot name="title">
            {{__('texts.chains_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
    <x-admin.v1.form.form title="{{__('forms.add_chain_title')}}"
                          description="{{__('forms.add_chain_description')}}"
                          url="{{route('chains.store')}}"
                          method="POST" fileable="false">
        <x-slot name="inputs">
            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="vendor_id"
                                          title="{{__('labels.vendor')}}">
                <x-slot name="options">
                    <option>Select</option>
                    @foreach($vendors as $id => $name)
                        <option @if(old('vendor_id') == $id) selected @endif value="{{$id}}">{{$name}}</option>
                    @endforeach
                </x-slot>
            </x-admin.v1.form.select-input>

            <x-admin.v1.form.text-input errorName="" prepend="" value="{{old('name')}}" size="col-md-6" name="name" title="{{__('labels.name')}}"
                                        placeholder="{{__('placeholders.name')}}"/>
            <x-admin.v1.form.text-area-input prepend="" value="{{old('info')}}" length="500" rows="4" size="col-md-6" name="info" title="{{__('labels.info')}}"
                                        placeholder="{{__('placeholders.info')}}"/>
        </x-slot>
        <x-slot name="buttons">
            <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit" title="{{__('labels.create')}}"/>
        </x-slot>
    </x-admin.v1.form.form>
            </div>
        </div>
    </div>
@endsection
