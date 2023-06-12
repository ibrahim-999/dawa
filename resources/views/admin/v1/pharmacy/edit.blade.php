@extends('admin.v1.layout')
@section('title',__('pages_title.edit_pharmacy')."|".$pharmacy->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.pharmacies_index')}}"
                                                         url="{{route('pharmacies.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.pharmacies_edit')}}-{{$pharmacy->name}}"
                                                         url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.pharmacies_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.edit_pharmacy_title')}}-{{$pharmacy->name}}"
                                      description="{{__('forms.edit_pharmacy_description')}}"
                                      url="{{route('pharmacies.update',$pharmacy->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <x-admin.v1.form.text-input errorName="" prepend="" value="{{$pharmacy->name}}" size="col-md-6" name="name"
                                                    title="{{__('labels.name')}}"
                                                    placeholder="{{__('placeholders.name')}}"/>
                        <x-admin.v1.form.text-area-input prepend="" value="{{$pharmacy->info}}" size="col-md-6" rows="4"
                                                         length="500" name="info"
                                                         title="{{__('labels.info')}}"
                                                         placeholder="{{__('placeholders.info')}}"/>

                        <x-admin.v1.form.text-area-input prepend="" value="{{$pharmacy->address}}" length="500" rows="4" size="col-md-6"
                        name="address" title="{{__('labels.address')}}"
                        placeholder="{{__('placeholders.address')}}"/>

                        <div class="form-group mb-3 col-md-6">
                                <div  class="input-group">
                                <input class="form-control" placeholder="Enter Location" id="pac-input" name="pac-input"/>
                            </div>
                        </div>
                        <div id="map" style="height: 400px;"></div>
                        <input type="hidden" value="{{ $pharmacy->lat }}" id="pac-lat" name="lat"/>
                        <input type="hidden" value="{{ $pharmacy->long }}" id="pac-lng" name="long"/>
                        <input type="hidden" value="{{ $pharmacy->place_id }}" id="pac-place-id" name="place_id"/>
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
<script
src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&libraries=places&v=weekly"
defer
></script>
<script src="{{asset('/')}}edit-map.js"></script>

@endsection