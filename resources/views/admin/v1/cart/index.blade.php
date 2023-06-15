@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.cart')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.cart')}}" url="" isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.carts')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>

    <div class="row">
         <div class="col-md-12">
            <x-admin.v1.table.table>

                <x-slot name="left_actions">
                 </x-slot>

                <x-slot name="right_actions">
                </x-slot>
                <x-slot name="headers">

                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Quantity</th>
                    <th>TotalPrice</th>
                    <th>Created at</th>
                    <th style="width: 85px;">Action</th>
                </x-slot>

                <x-slot name="rows">
                    @include('admin.v1.cart.partials.rows')
                </x-slot>
                <x-slot name="pagination">
                    <x-admin.v1.table.pagination>

                        <x-slot name="links">
                            {{$carts->links()}}
                        </x-slot>
                    </x-admin.v1.table.pagination>
                </x-slot>
            </x-admin.v1.table.table>
        </div>
    </div>
@endsection
