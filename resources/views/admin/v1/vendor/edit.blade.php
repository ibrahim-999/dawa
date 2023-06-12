@extends('admin.v1.layout')
@section('title',__('pages_title.edit_vendor')."|".$vendor->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.vendors_index')}}"
                                                         url="{{route('admin.vendors.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.vendors_edit')}}-{{$vendor->name}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.vendors_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.edit_vendor_title')}}-{{$vendor->name}}"
                                      description="{{__('forms.edit_vendor_description')}}"
                                      url="{{route('admin.vendors.update',$vendor->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <div class="row">
                            <x-admin.v1.form.text-input errorName="" prepend="" value="{{$vendor->name}}" size="col-md-6" name="name"
                                title="{{__('labels.name')}}"
                                placeholder="{{__('placeholders.name')}}"/>
                            <x-admin.v1.form.email-input value="{{$vendor->email}}" prepend="" size="col-md-6" name="email"
                                                        title="{{__('labels.email')}}"
                                                        placeholder="{{__('placeholders.email')}}"/>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="role"
                            title="{{__('labels.role')}}">
                                <x-slot name="options">
                                    <option>Select</option>
                                    @foreach($roles as $role)
                                        <option @if($vendor->roles?->first()?->name == $role) selected
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
