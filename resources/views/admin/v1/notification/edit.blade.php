@extends('admin.v1.layout')
@section('title',__('pages_title.edit_notification')."|".$campaign->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.notifications_index')}}"
                                                         url="{{route('notifications.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item
                title="{{__('labels.notifications_edit')}}-{{$campaign->name}}" url=""
                isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.notifications_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.edit_notification_title')}} - {{$campaign->name}}"
                                      description="{{__('forms.edit_user_description')}}"
                                      url="{{route('campaigns.update',$campaign->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <div class="row">
                            @foreach(config('translatable.locales') as $local)
                                <div class="col-md-6">
                                    <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend=""
                                                                value="{{$campaign->translate($local)->title}}"
                                                                size="col-md-12"
                                                                name="{{$local}}[title]"
                                                                title="{{__('labels.title',['local'=>$local])}}"
                                                                placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                                </div>
                            @endforeach
                            @foreach(config('translatable.locales') as $local)
                                <div class="col-md-6 subject_dev"
                                     @if($campaign->type!='email')
                                         style="display: none;"
                                    @endif >

                                    <x-admin.v1.form.text-area-input prepend=""
                                                                     value="{{$campaign->translate($local)->subject}}"
                                                                     length="500"
                                                                     rows="4" size="col-md-12"
                                                                     name="{{$local}}[subject]"
                                                                     title="{{__('labels.subject',['local'=>$local])}}"
                                                                     placeholder="{{__('placeholders.subject')}}"/>
                                </div>
                            @endforeach
                            @foreach(config('translatable.locales') as $local)
                                <div class="col-md-6">
                                    <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[description]')}}"
                                                                     length="500"
                                                                     rows="4" size="col-md-12"
                                                                     value="{{$campaign->translate($local)->description}}"
                                                                     name="{{$local}}[description]"
                                                                     title="{{__('labels.description',['local'=>$local])}}"
                                                                     placeholder="{{__('placeholders.description')}}"/>
                                </div>
                            @endforeach
                            <div class="col-md-12 mt-2">
                                <label>{{__('translatable.sent_type')}}</label>
                                <select class="form-control" name="sent_type" id="sent_type">
                                    <option value="">{{__('translatable.select')}}</option>
                                    <option
                                        value="now" {{$campaign->sent_type=='now'?'selected':null}}>
                                        {{__('translatable.now')}}</option>
                                    <option
                                        value="schedule" {{$campaign->sent_type=='schedule'?'selected':null}}>
                                        {{__('translatable.schedule')}}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2" id="date_div"
                                 @if(old('sent_type')!='schedule')
                                     style="display: none"
                                @endif>
                                <x-admin.v1.form.date-input prepend=""
                                                            value="{{$campaign->date??old('date')}}"
                                                            size="col-md-12"
                                                            name="date"
                                                            title="{{__('labels.date')}}"
                                                            placeholder="{{__('placeholders.date')}}"/>
                            </div>
                            <div class="col-md-6 mt-2" id="time_div"
                                 @if($campaign->sent_type!='schedule')
                                     style="display: none"
                                @endif>
                                <label>{{__('translatable.time')}}</label>
                                <input type="time" class="form-control"
                                       value="{{$campaign->time??old('time')}}" size="col-md-12"
                                       name="time"
                                       title="{{__('labels.time')}}"
                                       placeholder="{{__('placeholders.time')}}"/>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>{{__('translatable.type')}}</label>
                                <select class="form-control" name="type" id="notification_type">
                                    <option value="">{{__('translatable.select')}}</option>
                                    <option
                                        value="all" {{$campaign->type=='all'?'selected':null}}>{{__('translatable.all')}}</option>
                                    <option
                                        value="broadcast" {{$campaign->type=='broadcast'?'selected':null}}>{{__('translatable.broadcast')}}</option>
                                    <option
                                        value="sms" {{$campaign->type=='sms'?'selected':null}}>{{__('translatable.sms')}}</option>
                                    <option
                                        value="email" {{$campaign->type=='email'?'selected':null}}>{{__('translatable.email')}}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>{{__('translatable.sendTo')}}</label>
                                <select class="form-control" name="user_type" id="user_type">
                                    <option value="">{{__('translatable.select')}}</option>
                                    <option
                                        value="all">{{$campaign->user_type=='all'?'selected':null}}{{__('translatable.all')}}</option>
                                    <option
                                        value="users"{{$campaign->user_type=='users'?'selected':null}}>{{__('translatable.users')}}</option>
                                    <option
                                        value="vendors" {{$campaign->user_type=='vendors'?'selected':null}}>{{__('translatable.vendors')}}</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 " id="user_dev"
                                 @if($campaign->user_type!='users')
                                     style="display: none"
                                @endif>
                                <label>{{__('translatable.users')}}</label>
                                <select class="form-control selectpicker"
                                        data-actions-box="true"
                                        data-live-search="true"
                                        multiple name="user_id[]" id="user_id">
                                    @if($users->count())
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"
                                            @if($campaign->users->count())
                                                @foreach($campaign->users()->pluck('user_id') as $item)
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
                                 @if($campaign->user_type!='vendors')
                                     style="display: none"
                                @endif>
                                <label>{{__('translatable.vendors')}}</label>
                                <select class="form-control selectpicker" multiple
                                        data-live-search="true"
                                        data-actions-box="true"
                                        name="vendor_id[]" id="vendor_id">
                                    @if($vendors->count())
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}"
                                            @if($campaign->users->count())
                                                @foreach($campaign->users()->pluck('user_id') as $item)
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
                            <div class="col-md-12 mt-2 mb-2">
                                <label>{{__('translatable.status')}}</label>
                                <select class="form-control" name="status">
                                    <option value="">{{__('translatable.select')}}</option>
                                    <option
                                        value="active" {{$campaign->status=='active'?'selected':null}}>{{__('translatable.active')}}</option>
                                    <option
                                        value="inactive" {{$campaign->status=='inactive'?'selected':null}}>{{__('translatable.inactive')}}</option>
                                </select>
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
