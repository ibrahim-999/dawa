@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_brand')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.brands_index')}}" url="" isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.brands_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>

    <div class="row">
        <x-admin.v1.table.search-bar>
            <x-slot name="title">
                {{__('texts.brands_search')}}
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
                                              url="{{route('brands.create')}}">
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
            <th>name</th>
            <th>type</th>
            <th>Status</th>
            <th style="width: 85px;">Action</th>
        </x-slot>

        <x-slot name="rows">
            @include('admin.v1.brand.partials.rows')
        </x-slot>
        <x-slot name="pagination">
            <x-admin.v1.table.pagination>

                <x-slot name="links">
                    {{$brands->links()}}
                </x-slot>
            </x-admin.v1.table.pagination>
        </x-slot>
    </x-admin.v1.table.table>

@endsection
