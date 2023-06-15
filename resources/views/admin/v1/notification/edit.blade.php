@extends('admin.v1.layout')
@section('title',__('pages_title.edit_notification')."|".$notification->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.notifications_index')}}"
                                                         url="{{route('notifications.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.notifications_edit')}}-{{$notification->name}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.notifications_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.edit_notification_title')}} - {{$notification->name}}"
                                      description="{{__('forms.edit_user_description')}}"
                                      url="{{route('notifications.update',$notification->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <x-admin.v1.form.text-input errorName="" prepend="" value="{{$notification->name}}" size="col-md-6" name="name"
                                                    title="{{__('labels.name')}}"
                                                    placeholder="{{__('placeholders.name')}}"/>
                        <x-admin.v1.form.email-input value="{{$notification->email}}" prepend="" size="col-md-6" name="email"
                                                     title="{{__('labels.email')}}"
                                                     placeholder="{{__('placeholders.email')}}"/>

                    <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="phone[code]"
                                                     title="{{__('labels.phone_code')}}">


                       </x-admin.v1.form.select-input>
                       <x-admin.v1.form.text-input errorName="phone.number" prepend="" value="{{$user->national_phone_number}}" size="col-md-6" name="phone[number]"
                                                   title="{{__('labels.phone_number')}}"
                                                   placeholder="{{__('placeholders.phone.number')}}"/>


                        <x-admin.v1.form.password-input prepend="" size="col-md-6" name="password"
                                                        title="{{__('labels.password')}}"
                                                        placeholder="{{__('placeholders.password')}}"/>
                        <x-admin.v1.form.password-input prepend="" size="col-md-6" name="password_confirmation"
                                                        title="{{__('labels.password_confirmation')}}"
                                                        placeholder="{{__('placeholders.password_confirmation')}}"/>
                        <x-admin.v1.form.checkbox-input value="1" checked="{{ $user->is_active ? 1 : 0 }}" size="col-md-6" name="is_active"
                        title="{{__('labels.is_active')}}"/>

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
