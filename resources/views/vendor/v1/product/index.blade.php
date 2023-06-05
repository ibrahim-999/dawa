@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_product')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.products_index')}}" url="" isActive="1"/>
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
                    <h3><span data-plugin="counterup">{{$products->total()}}</span></h3>
                    <p class="text-muted font-15 mb-0">{{__('labels.total')}}</p>
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
        <x-admin.v1.table.search-bar>
            <x-slot name="title">
                {{__('texts.products_search')}}
            </x-slot>
            <x-slot name="inputs">
                <div class="col-md-4">
                    <x-admin.v1.form.text-input errorName="" prepend="" value="{{request('search')}}" size="col-md-6" name="search"
                                                title="{{__('labels.search')}}"
                                                placeholder="{{__('placeholders.search')}}"/>
                </div>
            </x-slot>
        </x-admin.v1.table.search-bar>
    </div>
    <x-admin.v1.table.table>

        <x-slot name="left_actions">
            <x-admin.v1.buttons.reference-btn btnType="btn-danger waves-effect waves-light"
                                              url="{{route('products.create')}}">
                <x-slot name="title">
                    <i class="mdi mdi-plus-circle mr-1"></i> {{__('labels.add')}}
                </x-slot>
            </x-admin.v1.buttons.reference-btn>
        </x-slot>

        <x-slot name="right_actions">
        </x-slot>
        <x-slot name="headers">
            <th style="width: 20px;">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                </div>
            </th>
            <th>Name</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Status</th>
            <th style="width: 85px;">Action</th>
        </x-slot>

        <x-slot name="rows">
            @include('admin.v1.product.partials.rows')
        </x-slot>
        <x-slot name="pagination">
            <x-admin.v1.table.pagination>

                <x-slot name="links">
                    {{$products->links()}}
                </x-slot>
            </x-admin.v1.table.pagination>
        </x-slot>
    </x-admin.v1.table.table>

@endsection
