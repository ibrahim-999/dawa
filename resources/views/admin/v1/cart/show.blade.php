@extends('admin.v1.layout')
@section('title',__('pages_title.show_cart'))
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.cart')}}"
                                                         url="{{route('cart.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.show_cart')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>

    <div class="card-box widget-inline">
        <div class="row">
            <div class="col-sm-6 col-xl-6">
                <div class="p-2 text-center">
                    <i class="mdi mdi-shopping text-primary mdi-24px"></i>
                    <h3><span data-plugin="counterup">{{$cart->total_quantity}}</span></h3>
                    <p class="text-muted font-15 mb-0">{{__('labels.variants_count')}}</p>
                </div>
            </div>

            <div class="col-sm-6 col-xl-6">
                <div class="p-2 text-center">
                    <i class="mdi mdi-currency-usd text-success mdi-24px"></i>
                    <h3>$ <span data-plugin="counterup">{{$cart->total_price}}</span></h3>
                    <p class="text-muted font-15 mb-0">Total Price</p>
                </div>
            </div>

        </div> <!-- end row -->
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- end card-box-->
            @include('admin.v1.cart.partials.cart_data')

        </div>
        <div class="col-lg-8">
            @include('admin.v1.cart.partials.variants_table')

            <!-- end card-->
        </div> <!-- end col -->

    </div>
@endsection
