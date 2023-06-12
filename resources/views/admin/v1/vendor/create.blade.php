@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_vendor')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.vendors_index')}}"
                                                         url="{{route('admin.vendors.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.vendors_create')}}" url="" isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.vendors_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.add_vendor_title')}}"
                                      description="{{__('forms.add_vendor_description')}}"
                                      url="{{route('admin.vendors.store')}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <div class="row">
                            <x-admin.v1.form.text-input errorName="" prepend="" value="{{old('name')}}" size="col-md-6" name="name"
                            title="{{__('labels.name')}}"
                            placeholder="{{__('placeholders.name')}}"/>
                            <x-admin.v1.form.email-input value="{{old('email')}}" prepend="" size="col-md-6" name="email"
                                                        title="{{__('labels.email')}}"
                                                        placeholder="{{__('placeholders.email')}}"/>
                        </div>

                        <div class="row">
                            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="role"
                            title="{{__('labels.role')}}">
                                <x-slot name="options">
                                    <option>Select</option>
                                    @foreach($roles as $role)
                                        <option @if(old('role') == $role) selected
                                                @endif value="{{$role}}">{{$role}}</option>
                                    @endforeach
                                </x-slot>
                                </x-admin.v1.form.select-input>

                            <x-admin.v1.form.password-input prepend="" size="col-md-6" name="password"
                                                        title="{{__('labels.password')}}"
                                                        placeholder="{{__('placeholders.password')}}"/>
                        </div>
                        <div class="row">
                        <x-admin.v1.form.password-input prepend="" size="col-md-6" name="password_confirmation"
                                                        title="{{__('labels.password_confirmation')}}"
                                                        placeholder="{{__('placeholders.password_confirmation')}}"/>
                        </div>
                        <x-admin.v1.form.checkbox-input value="1" checked="1" size="col-md-6" name="invite"
                                                        title="{{__('labels.send_invitation')}}"/>
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
