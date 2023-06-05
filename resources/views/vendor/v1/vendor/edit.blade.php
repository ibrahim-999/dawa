@extends('admin.v1.layout')
@section('title',__('pages_title.edit_admin')."|".$admin->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.admins_index')}}"
                                                         url="{{route('admins.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.admins_edit')}}-{{$admin->name}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.admins_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.edit_admin_title')}}-{{$admin->name}}"
                                      description="{{__('forms.edit_admin_description')}}"
                                      url="{{route('admins.update',$admin->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <x-admin.v1.form.text-input errorName="" prepend="" value="{{$admin->name}}" size="col-md-6" name="name"
                                                    title="{{__('labels.name')}}"
                                                    placeholder="{{__('placeholders.name')}}"/>
                        <x-admin.v1.form.email-input value="{{$admin->email}}" prepend="" size="col-md-6" name="email"
                                                     title="{{__('labels.email')}}"
                                                     placeholder="{{__('placeholders.email')}}"/>
                        <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="role"
                                                      title="{{__('labels.role')}}">
                            <x-slot name="options">
                                <option>Select</option>
                                @foreach($roles as $role)
                                    <option @if($admin->roles?->first()?->name == $role) selected
                                            @endif value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </x-slot>
                        </x-admin.v1.form.select-input>

                        <x-admin.v1.form.password-input prepend="" size="col-md-6" name="password"
                                                        title="{{__('labels.password')}}"
                                                        placeholder="{{__('placeholders.password')}}"/>
                        <x-admin.v1.form.password-input prepend="" size="col-md-6" name="password_confirmation"
                                                        title="{{__('labels.password_confirmation')}}"
                                                        placeholder="{{__('placeholders.password_confirmation')}}"/>
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
