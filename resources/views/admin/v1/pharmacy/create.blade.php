@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_pharmacy')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.pharmacies_index')}}"
                                                         url="{{route('pharmacies.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.pharmacies_create')}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.pharmacies_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
    <x-admin.v1.form.form title="{{__('forms.add_pharmacy_title')}}"
                          description="{{__('forms.add_pharmacy_description')}}"
                          url="{{route('pharmacies.store')}}"
                          method="POST" fileable="false">
        <x-slot name="inputs">
            <div class="row">
            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="chain_id"
                                          title="{{__('labels.chain')}}">
                <x-slot name="options">
                    <option>Select</option>
                    @foreach($chains as $id => $name)
                        <option @if(old('chain_id') == $id) selected @endif value="{{$id}}">{{$name}}</option>
                    @endforeach
                </x-slot>
            </x-admin.v1.form.select-input>

            <x-admin.v1.form.text-input errorName="" prepend="" value="{{old('name')}}" size="col-md-6" name="name"
                                        title="{{__('labels.name')}}"
                                        placeholder="{{__('placeholders.name')}}"/>
            <x-admin.v1.form.text-area-input prepend="" value="{{old('info')}}" length="500" rows="4" size="col-md-6"
                                             name="info" title="{{__('labels.info')}}"
                                             placeholder="{{__('placeholders.info')}}"/>
            <x-admin.v1.form.text-area-input prepend="" value="{{old('address')}}" length="500" rows="4" size="col-md-6"
                                             name="address" title="{{__('labels.address')}}"
                                             placeholder="{{__('placeholders.address')}}"/>


            <div class="form-group mb-3 col-md-12">
                    <div  class="input-group">
                    <input class="form-control" placeholder="Enter Location" id="pac-input" name="pac-input"/>
                </div>
            </div>
        </div>
        <div id="map" style="height: 400px;"></div>
        <input type="hidden" value="{{old('lat')}}" id="pac-lat" name="lat"/>
        <input type="hidden" value="{{old('long')}}" id="pac-lng" name="long"/>
        <input type="hidden" value="{{old('place_id')}}" id="pac-place-id" name="place_id"/>
        </x-slot>
        <x-slot name="buttons">
            <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit" title="{{__('labels.create')}}"/>
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
<script src="{{asset('/')}}map.js"></script>

@endsection
