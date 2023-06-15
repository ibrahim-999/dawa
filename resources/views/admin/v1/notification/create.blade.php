@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_notification')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.notifications_index')}}"
                                                         url="{{route('notifications.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.notifications_create')}}" url="" isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.notification_create_header')}}
        </x-slot>

    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card" >
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.add_notification_title')}}"
                                      description="{{__('forms.add_notification_description')}}"
                                      url="{{route('notifications.store')}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        @foreach(config('translatable.locales') as $local)
                            <div class="col-md-12">
                                <h5>{{__('labels.language')}}-{{ucfirst($local)}}</h5>
                            </div>
                            <div class="row">
                                <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend="" value="{{old($local.'[title]')}}" size="col-md-6"
                                                            name="{{$local}}[title]"
                                                            title="{{__('labels.title',['local'=>$local])}}"
                                                            placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                             </div>
                            <div class="row">
                                <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[subject]')}}" length="500"
                                                                 rows="4" size="col-md-6"
                                                                 name="{{$local}}[subject]"
                                                                 title="{{__('labels.subject',['local'=>$local])}}"
                                                                 placeholder="{{__('placeholders.subject')}}"/>
                                <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[description]')}}" length="500"
                                                                 rows="4" size="col-md-6"
                                                                 name="{{$local}}[description]"
                                                                     title="{{__('labels.description',['local'=>$local])}}"
                                                                 placeholder="{{__('placeholders.description')}}"/>

                            </div>
                        @endforeach
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
