@extends('admin.v1.layout')
@section('title',__('pages_title.loyalty_settings'))
@section('content')
<x-admin.v1.layout.partials.basic-page-header>
    <x-slot name="breadcrumbs">
        <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                     isActive="0"/>
        <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.loyalty_setting_show')}}"
                                                     url="{{route('settings.loyalty_settings')}}" isActive="0"/>
    </x-slot>
    <x-slot name="title">
        {{__('texts.loyalty_setting_index_header')}}
    </x-slot>
</x-admin.v1.layout.partials.basic-page-header>
{{-- start of taps --}}
<div class="col-xl-12">
    <div class="card-box">
        <h4 class="header-title mb-4">loyalty point setting</h4>

        <ul class="nav nav-pills navtab-bg nav-justified">
            <li class="nav-item">
                <a href="#loyaltyPointSetting" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    {{__('labels.loyalty_point_setting')}}
                </a>
            </li>
            <li class="nav-item">
                <a href="#loyaltyPointAction" data-toggle="tab" aria-expanded="false" class="nav-link">
                    {{__('labels.loyalty_point_action')}}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="loyaltyPointSetting">
                {{-- form of loyalty point setting --}}
                <div class="col-lg-12">
                    <div class="card" >
                        <div class="card-body">
                            <x-admin.v1.form.form title="{{__('forms.edit_loyalty_point_setting_title')}}"
                                description="{{__('forms.edit_loyalty_point_setting_description')}}"
                                url="{{route('settings.loyalty_point_settings.update')}}"
                                method="POST" fileable="false">
                                <x-slot name="inputs">
                                <div class="row">    
                                    @method('PATCH')
                                    @foreach ($loyaltyPointSettings as  $loyaltyPointSetting)
                                        <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{$loyaltyPointSetting->fixed_value}}" prepend="" size="col-md-6" name="{{$loyaltyPointSetting->key}}"
                                            title="{{__('labels.'.$loyaltyPointSetting->key)}}"
                                            placeholder="{{__('placeholders.'.$loyaltyPointSetting->key)}}"/>
                                    @endforeach
                                </div>
            
                                </x-slot>
                                <x-slot name="buttons">
                                    <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                                    title="{{__('labels.update')}}"/>
                                </x-slot>
                            </x-admin.v1.form.form>
                        </div>
                    </div>
                </div>
                {{-- end of loyaltypoint --}}
            </div>

            <div class="tab-pane" id="loyaltyPointAction">
                {{-- form of loyalty point actions --}}
                <div class="col-lg-12">
                    <div class="card" >
                        <div class="card-body">
                            <x-admin.v1.form.form title="{{__('forms.edit_loyalty_point_action_title')}}"
                                description="{{__('forms.edit_loyalty_point_action_description')}}"
                                url="{{route('settings.loyalty_point_actions.update')}}"
                                method="POST" fileable="false">
                                <x-slot name="inputs">
                                <div class="row">    
                                    @method('PATCH')
                                    @foreach ($loyaltyPointActions as  $loyaltyPointAction)
                                        <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{$loyaltyPointAction->fixed_value}}" prepend="" size="col-md-6" name="{{$loyaltyPointAction->key}}"
                                            title="{{__('labels.'.$loyaltyPointAction->key)}}"
                                            placeholder="{{__('placeholders.'.$loyaltyPointAction->key)}}"/>
                                    @endforeach
                                </div>
            
                                </x-slot>
                                <x-slot name="buttons">
                                    <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                                    title="{{__('labels.update')}}"/>
                                </x-slot>
                            </x-admin.v1.form.form>
                        </div>
                    </div>
                </div>
                {{-- end of action point --}}
            </div>
        </div>
    </div> <!-- end card-box-->
</div> <!-- end col -->
{{-- end of tabs --}}
@endsection

