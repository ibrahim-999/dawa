@extends('admin.v1.layout')
@section('title')
    {{__("pages_title.create{$guard}_role")}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.roles_index')}}"
                                                         url="{{route('roles.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.roles_create')}}" url="" isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__("texts.{$guard}_roles_index_header")}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.permissions_for_'.$guard)}}"
                                      description="{{__('forms.permissions_for_'.$guard)}}"
                                      url="{{route('roles.store')}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <div class="col-lg-12">
                            <div class="card"
                                 style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 5px 0 rgba(0, 0, 0, 0.19) ">
                                <div class="card-body">
                                    <x-admin.v1.form.text-input errorName="" prepend="" value="{{old('name')}}" size="col-md-6"
                                                                name="name"
                                                                title="{{__('labels.role_name')}}"
                                                                placeholder="{{__('placeholders.name')}}"/>
                                    <input hidden name="guard_name" type="text" value="{{$guard}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h4 class="header-title">{{__("labels.{$guard}_permissions")}}</h4>
                            <p class="sub-header">
                                {{__("texts.{$guard}_permissions_description")}}
                            </p>
                        </div>
                        @php
                            $ribbonColors=['blue','primary','success','info','warning','danger','pink','secondary','dark'];
                            $ribbonColor=0;
                        @endphp
                        @forelse($permissions as $module=>$permissions)

                            <x-admin.v1.form.checkbox-group ribbonColorText="{{$ribbonColors[$ribbonColor]}}"
                                                            groupName="{{$module}}">
                                <x-slot name="options">
                                    @foreach($permissions as $permission)
                                        <x-admin.v1.form.checkbox-input
                                            class="form-group row mb-3 justify-content-end select-group-input-per "
                                            checked="" name="permissions[]"
                                            value="{{$permission->name}}"
                                            title="{{__('permissions.'.$permission->name)}}"/>
                                    @endforeach
                                </x-slot>
                            </x-admin.v1.form.checkbox-group>
                            @php
                                $ribbonColor++;
                                if ($ribbonColor > count($ribbonColors))
                                    {
                                        $ribbonColor=0;
                                    }
                            @endphp
                        @empty
                            <div class="col-lg-12">
                                <div class="card"
                                     style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 5px 0 rgba(0, 0, 0, 0.19) ">
                                    <div class="card-body">
                                        <p class="text-center">No Permissions Yet</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </x-slot>
                    <x-slot name="buttons">
                        <div class="col-lg-12">
                            <div class="card"
                                 style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19) ">
                                <div class="card-body">
                                    <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                                    title="{{__('labels.create')}}"/>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-admin.v1.form.form>
            </div>
        </div>
    </div>
@endsection
