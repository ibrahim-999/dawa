@extends('admin.v1.layout')
@section('title',__('pages_title.show_chain')."|".$chain->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.chains_index')}}"
                                                         url="{{route('chains.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.chains_show')}}-{{$chain->name}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.chains_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="row">

        <div class="col-lg-4">
            <!-- end card-box-->
            @include('admin.v1.chain.partials.chain_data')
        </div>
        <div class="col-lg-8">
            @include('admin.v1.chain.partials.pharmacies_table')
            @include('admin.v1.chain.partials.accesses_table')
            <!-- end card-->
        </div> <!-- end col -->

    </div>
@endsection
