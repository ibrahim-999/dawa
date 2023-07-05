@extends('admin.v1.layout')
@section('title',__('pages_title.edit_campaign')."|".$campaign->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.campaigns_index')}}"
                                                         url="{{route('campaigns.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item
                title="{{__('labels.campaigns_edit')}}-{{$campaign->name}}" url=""
                isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.campaign_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.edit_campaign_title')}} - {{$campaign->name}}"
                                      description="{{__('forms.edit_user_description')}}"
                                      url="{{route('campaigns.update',$campaign->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <div class="row">
                            @include('admin.v1.campaign.partials.update-partials.title-component')
                            @include('admin.v1.campaign.partials.update-partials.description-component')
                            @include('admin.v1.campaign.partials.update-partials.subject-component')

                            <div class="col-md-12 mt-2">
                                <label>{{__('forms.send_type')}}</label>
                                <select class="form-control" name="sent_type" id="sent_type">
                                    <option value="">{{__('forms.select')}}</option>
                                    <option
                                        value="1" {{$campaign->sent_type=='1'?'selected':null}}>
                                        {{__('forms.now')}}</option>
                                    <option
                                        value="2" {{$campaign->sent_type=='2'?'selected':null}}>
                                        {{__('forms.schedule')}}</option>
                                </select>
                            </div>

                            <div class="col-md-12 mt-2" id="schedule_type_dev"
                                 @if($campaign->sent_type!='2')
                                     style="display: none"
                                @endif>
                                <label>{{__('forms.schedule_type')}}</label>
                                <select class="form-control" name="schedule_type" id="schedule_type">
                                    <option
                                        value="1" {{$campaign->schedule_type=='1'?'selected':null}}>
                                        {{__('forms.daily')}}</option>
                                    <option
                                        value="2" {{$campaign->schedule_type=='2'?'selected':null}}>
                                        {{__('forms.weekly')}}</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2" id="days_of_week_dev"
                                 @if($campaign->schedule_type!='2')
                                     style="display: none"
                                @endif>
                                <label>{{__('forms.days_of_week')}}</label>
                                <select class="form-control" name="days_of_week" id="days_of_week">
                                    <option
                                        value="1"{{$campaign->days_of_week=='1'?'selected':null}}>{{__('forms.saturday')}}</option>
                                    <option
                                        value="2"{{$campaign->days_of_week=='2'?'selected':null}}>{{__('forms.sunday')}}</option>
                                    <option
                                        value="3"{{$campaign->days_of_week=='3'?'selected':null}}>{{__('forms.monday')}}</option>
                                    <option
                                        value="4"{{$campaign->days_of_week=='4'?'selected':null}}>{{__('forms.tuesday')}}</option>
                                    <option
                                        value="5"{{$campaign->days_of_week=='5'?'selected':null}}>{{__('forms.wednesday')}}</option>
                                    <option
                                        value="6"{{$campaign->days_of_week=='6'?'selected':null}}>{{__('forms.thursday')}}</option>
                                    <option
                                        value="7"{{$campaign->days_of_week=='7'?'selected':null}}>{{__('forms.friday')}}</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-2" id="start_date_div"
                                 @if($campaign->sent_type!='2')
                                     style="display: none"
                                @endif>
                                <x-admin.v1.form.date-time-input
                                    prepend=""
                                    value="{{$campaign->end_date??old('start_date')}}" size="col-md-12"
                                    name="start_date"
                                    title="{{__('labels.start_date')}}"
                                    placeholder="{{__('placeholders.date')}}"/>
                            </div>
                            <div class="col-md-6 mt-2" id="end_date_div"
                                 @if($campaign->sent_type!='2')
                                     style="display: none"
                                @endif>
                                <x-admin.v1.form.date-time-input
                                    prepend=""
                                    value="{{$campaign->end_date??old('end_date')}}" size="col-md-12"
                                    name="end_date"
                                    title="{{__('labels.end_date')}}"
                                    placeholder="{{__('placeholders.date')}}"/>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>{{__('forms.type')}}</label>
                                <select class="form-control" name="type" id="notification_type">
                                    <option value="">{{__('forms.select')}}</option>
                                    <option
                                        value="1" {{$campaign->type=='1'?'selected':null}}>{{__('forms.all')}}</option>
                                    <option
                                        value="3" {{$campaign->type=='3'?'selected':null}}>{{__('forms.fcm')}}</option>
                                    <option
                                        value="4" {{$campaign->type=='4'?'selected':null}}>{{__('forms.sms')}}</option>
                                    <option
                                        value="2" {{$campaign->type=='2'?'selected':null}}>{{__('forms.email')}}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>{{__('forms.send_to')}}</label>
                                <select class="form-control" name="user_type" id="user_type">
                                    <option value="">{{__('forms.select')}}</option>
                                    <option
                                        value="1"{{$campaign->user_type=='1'?'selected':null}}>{{__('forms.all')}}</option>
                                    <option
                                        value="2"{{$campaign->user_type=='2'?'selected':null}}>{{__('forms.users')}}</option>
                                    <option
                                        value="3" {{$campaign->user_type=='3'?'selected':null}}>{{__('forms.vendors')}}</option>
                                </select>
                            </div>

                            <div class="col-md-12 mt-2 " id="user_dev"
                                 @if($campaign->user_type!='2')
                                     style="display: none"
                                @endif>
                                <label>{{__('forms.users')}}</label>
                                <select class="form-control selectpicker"
                                        data-actions-box="true"
                                        data-live-search="true"
                                        multiple name="user_id[]" id="user_id">
                                    @if($users->count())
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"
                                            @if($users_selected)
                                                @foreach($users_selected as $item)
                                                    @if($item==$user->id)
                                                        {{'selected'}}
                                                        @endif
                                                    @endforeach
                                                @endif>
                                                {{$user->name??'-'}}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="col-md-12 mt-2 " id="vendor_dev"
                                 @if($campaign->user_type!='3')
                                     style="display: none"
                                @endif>
                                <label>{{__('forms.vendors')}}</label>
                                <select class="form-control selectpicker" multiple
                                        data-live-search="true"
                                        data-actions-box="true"
                                        name="vendor_id[]" id="vendor_id">
                                    @if($vendors->count())
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}"
                                            @if($vendors_selected)
                                                @foreach($vendors_selected as $item)
                                                    @if($item==$vendor->id)
                                                        {{'selected'}}
                                                        @endif
                                                    @endforeach
                                                @endif>
                                                {{$vendor->name??'-'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mt-2">
                                <x-admin.v1.form.checkbox-input value="1"
                                                                checked="{{ $campaign->is_active ? 1 : 0 }}"
                                                                size="col-md-4" name="is_active"
                                                                title="{{__('labels.is_active')}}"/>
                            </div>

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

@section('scripts')
    <script src="{{asset('admin-panel-assets/v1/js/campaigns.js')}}"></script>
@endsection
