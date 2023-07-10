@extends('admin.v1.layout')
@section('title',__('pages_title.show_variant')."|".$variant->title)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.products_index')}}"
                                                         url="{{route('products.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{$variant->title}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.products_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>

    <div class="card-box widget-inline">
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="p-2 text-center">
                    <i class="mdi mdi-shopping text-primary mdi-24px"></i>
                    <h3><span data-plugin="counterup">{50}}</span></h3>
                    <p class="text-muted font-15 mb-0">{{__('labels.variants_count')}}</p>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="p-2 text-center">
                    <i class="mdi mdi-currency-usd text-success mdi-24px"></i>
                    <h3>$ <span data-plugin="counterup">7841</span></h3>
                    <p class="text-muted font-15 mb-0">Income Amounts</p>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="p-2 text-center">
                    <i class="mdi mdi-account-group text-danger mdi-24px"></i>
                    <h3><span data-plugin="counterup">6521</span></h3>
                    <p class="text-muted font-15 mb-0">Total Users</p>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="p-2 text-center">
                    <i class="mdi mdi-eye-outline text-blue mdi-24px"></i>
                    <h3><span data-plugin="counterup">325</span> k</h3>
                    <p class="text-muted font-15 mb-0">Total Visits</p>
                </div>
            </div>

        </div> <!-- end row -->
    </div>

    <div class="row">

        <div class="col-lg-4">
            <!-- end card-box-->
            @include('admin.v1.product.partials.variant.variant_data')
        </div>

        <div class="col-lg-8">
            @include('admin.v1.product.partials.variant.variant_images')
            <!-- end card-->
        </div> <!-- end col -->

    </div>
@endsection
