@extends('admin.v1.layout')
@section('title',__('pages_title.edit_chain')."|".$chain->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.chains_index')}}"
                                                         url="{{route('chains.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.chains_edit')}}-{{$chain->name}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.chains_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.edit_chain_title')}}-{{$chain->name}}"
                                      description="{{__('forms.edit_chain_description')}}"
                                      url="{{route('chains.update',$chain->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">

                        <x-admin.v1.form.text-input errorName="" prepend="" value="{{$chain->name}}" size="col-md-6" name="name"
                                                    title="{{__('labels.name')}}"
                                                    placeholder="{{__('placeholders.name')}}"/>
                        <x-admin.v1.form.text-area-input prepend="" value="{{$chain->info}}" size="col-md-6" rows="4"
                                                         length="500" name="info"
                                                         title="{{__('labels.info')}}"
                                                         placeholder="{{__('placeholders.info')}}"/>
                        @method('PATCH')
                    </x-slot>
                    <x-slot name="buttons">
                        <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                        title="{{__('labels.update')}}"/>
                    </x-slot>
                </x-admin.v1.form.form>
            </div>
        </div>
    </div>
@endsection
