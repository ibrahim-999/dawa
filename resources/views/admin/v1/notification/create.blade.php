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
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.notifications_create')}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.notification_create_header')}}
        </x-slot>

    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.add_notification_title')}}"
                                      description="{{__('forms.add_notification_description')}}"
                                      url="{{route('notifications.store')}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <div class="row">
                            @foreach(config('translatable.locales') as $local)
                                <div class="col-md-6">
                                    <x-admin.v1.form.text-input errorName="{{$local}}.title" prepend=""
                                                                value="{{old($local.'[title]')}}" size="col-md-12"
                                                                name="{{$local}}[title]"
                                                                title="{{__('labels.title',['local'=>$local])}}"
                                                                placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                                </div>
                            @endforeach
                            @foreach(config('translatable.locales') as $local)
                                <div class="col-md-6 subject_dev"
                                     @if(old('type')!='email')
                                         style="display: none;"
                                    @endif >

                                    <x-admin.v1.form.text-area-input prepend="" value="{{old($local.'[subject]')}}"
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
                                        value="now" {{old('sent_type')=='now'?'selected':null}}>
                                        {{__('translatable.now')}}</option>
                                    <option
                                        value="schedule" {{old('sent_type')=='schedule'?'selected':null}}>
                                        {{__('translatable.schedule')}}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2" id="date_div"
                                 @if(old('sent_type')!='schedule')
                                     style="display: none"
                                @endif>
                                <x-admin.v1.form.date-input prepend=""
                                                            value="{{old('date')}}" size="col-md-12"
                                                            name="date"
                                                            title="{{__('labels.date')}}"
                                                            placeholder="{{__('placeholders.date')}}"/>
                            </div>
                            <div class="col-md-6 mt-2" id="time_div"
                                 @if(old('sent_type')!='schedule')
                                     style="display: none"
                                @endif>
                                <label>{{__('translatable.time')}}</label>
                                <input type="time" class="form-control"
                                       value="{{old('time')}}" size="col-md-12"
                                       name="time"
                                       title="{{__('labels.time')}}"
                                       placeholder="{{__('placeholders.time')}}"/>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>{{__('translatable.type')}}</label>
                                <select class="form-control" name="type" id="notification_type">
                                    <option value="">{{__('translatable.select')}}</option>
                                    <option
                                        value="all" {{old('type')=='all'?'selected':null}}>{{__('translatable.all')}}</option>
                                    <option
                                        value="broadcast" {{old('type')=='broadcast'?'selected':null}}>{{__('translatable.broadcast')}}</option>
                                    <option
                                        value="sms" {{old('type')=='sms'?'selected':null}}>{{__('translatable.sms')}}</option>
                                    <option
                                        value="email" {{old('type')=='email'?'selected':null}}>{{__('translatable.email')}}</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>{{__('translatable.sendTo')}}</label>
                                <select class="form-control" name="user_type" id="user_type">
                                    <option value="">{{__('translatable.select')}}</option>
                                    <option
                                        value="all">{{old('user_type')=='all'?'selected':null}}{{__('translatable.all')}}</option>
                                    <option
                                        value="users"{{old('user_type')=='users'?'selected':null}}>{{__('translatable.users')}}</option>
                                    <option
                                        value="vendors" {{old('user_type')=='vendors'?'selected':null}}>{{__('translatable.vendors')}}</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 " id="user_dev"
                                 @if(old('user_type')!='users')
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
                                            @if(old("user_id"))
                                                {{ in_array($users, old("user_id")) ?? [] ? 'selected' : '' }}
                                                @endif>
                                                {{$user->name??'-'}}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="col-md-12 mt-2 " id="vendor_dev"
                                 @if(old('user_type')!='vendors')
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
                                            @if(old("vendor_id"))
                                                {{ in_array($vendors, old("vendor_id")) ?? [] ? 'selected' : '' }}
                                                @endif
                                            >{{$vendor->name??'-'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>{{__('translatable.status')}}</label>
                                <select class="form-control" name="status">
                                    <option value="">{{__('translatable.select')}}</option>
                                    <option
                                        value="active" {{old('status')=='active'?'selected':null}}>{{__('translatable.active')}}</option>
                                    <option
                                        value="inactive" {{old('status')=='inactive'?'selected':null}}>{{__('translatable.inactive')}}</option>
                                </select>
                            </div>

                        </div>


                    </x-slot>
                    <x-slot name="buttons">
                        <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit" class="mt-5"
                                                        title="{{__('labels.create')}}"/>
                    </x-slot>
                </x-admin.v1.form.form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#notification_type').on('change', function () {
            if ($(this).val() == 'email') {
                $('.subject_dev').fadeIn();
            } else {
                $('.subject_dev').fadeOut();
            }
        });
        $('#sent_type').on('change', function () {
            $('#date').val('');
            $('#time_input').val('');
            if ($(this).val() == 'schedule') {
                $('#date_div').fadeIn();
                $('#time_dev').fadeIn();
            } else {
                $('#date_dev').fadeOut();
                $('#time_dev').fadeOut();
            }
        });

        $('#user_type').on('change', function () {
            if ($(this).val() == 'vendors') {
                $('#user_id').val('');
                $('#vendor_id').val('');
                $('#user_dev').fadeOut();
                $('#vendor_dev').fadeIn();

            }
            if ($(this).val() == 'users') {
                $('#user_id').val('');
                $('#vendor_id').val('');
                $('#user_dev').fadeIn();
                $('#vendor_dev').fadeOut();
            }
            if ($(this).val() == 'all') {
                $('#user_id').val('');
                $('#vendor_id').val('');
                $('#user_dev').fadeOut();
                $('#vendor_dev').fadeOut();
            }
        });

    </script>
@endsection
