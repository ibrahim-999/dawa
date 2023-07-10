@extends('admin.v1.layout')
@section('title',__('pages_title.show_offer')."|".$offer->title)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.offers_index')}}"
                                                         url="{{route('offers.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.offer_show')}}-{{$offer->name}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.pharmacies_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="row">

        <div class="col-lg-4">
            <!-- end card-box-->
            @include('admin.v1.offer.partials.offer_data')
        </div>
        <div class="col-lg-8">
            @include('admin.v1.offer.partials.variant_table')
            <!-- end card-->
        </div> <!-- end col -->

    </div>
@endsection
