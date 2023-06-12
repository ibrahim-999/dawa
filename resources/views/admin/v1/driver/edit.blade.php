@extends('admin.v1.layout')
@section('title',__('pages_title.edit_driver')."|".$driver->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.drivers_index')}}"
                                                         url="{{route('drivers.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.drivers_edit')}}-{{$driver->name}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.drivers_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

                </div>
                <x-admin.v1.form.form title="{{__('forms.edit_driver_title')}} - {{$driver->name}}"
                                      description="{{__('forms.edit_driver_description')}}"
                                      url="{{route('drivers.update',$driver->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <div class="row">
                            <x-admin.v1.form.text-input errorName="" prepend="" value="{{$driver->name}}" size="col-md-6" name="name"
                                title="{{__('labels.name')}}"
                                placeholder="{{__('placeholders.name')}}"/>
                            <x-admin.v1.form.email-input value="{{$driver->email}}" prepend="" size="col-md-6" name="email"
                                                        title="{{__('labels.email')}}"
                                                        placeholder="{{__('placeholders.email')}}"/>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="phone[code]"
                            title="{{__('labels.phone_code')}}">
                                <x-slot name="options">
                                    @php
                                        $codes = ['SA','EG'];
                                    @endphp                                
                                    <option>Select</option>
                                    @foreach($codes as $code)
                                        <option @if($driver->phone_country_code == $code) selected
                                                @endif value="{{$code}}">{{$code}}</option>
                                    @endforeach
                                </x-slot>
                                </x-admin.v1.form.select-input>
                            <x-admin.v1.form.text-input errorName="phone.number" prepend="" value="{{$driver->national_phone_number}}" size="col-md-6" name="phone[number]"
                                                    title="{{__('labels.phone_number')}}"
                                                    placeholder="{{__('placeholders.phone.number')}}"/>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.password-input prepend="" size="col-md-6" name="password"
                            title="{{__('labels.password')}}"
                            placeholder="{{__('placeholders.password')}}"/>
                            <x-admin.v1.form.password-input prepend="" size="col-md-6" name="password_confirmation"
                                                        title="{{__('labels.password_confirmation')}}"
                                                        placeholder="{{__('placeholders.password_confirmation')}}"/>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="status"
                            title="{{__('labels.status')}}">
                                <x-slot name="options">                                
                                    <option>Select</option>

                                    <option @if($driver->status == '1') selected
                                            @endif value="{{'1'}}">{{'under_review'}}</option>
                                    <option @if($driver->status == '2') selected
                                        @endif value="{{'2'}}">{{'pending'}}</option>
                                    <option @if($driver->status == '3') selected
                                        @endif value="{{'3'}}">{{'approved'}}</option>
                                    <option @if($driver->status == '4') selected
                                        @endif value="{{'4'}}">{{'rejected'}}</option>    

                                </x-slot>
                                </x-admin.v1.form.select-input>
                            <x-admin.v1.form.checkbox-input value="1" checked="{{ $driver->is_active ? 1 : 0 }}" size="col-md-6" name="is_active"
                                title="{{__('labels.is_active')}}"/>
                        </div>    
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
