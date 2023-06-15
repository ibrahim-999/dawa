@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.index_offers')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.offer_index')}}" url="" isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.offer_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>

    <x-admin.v1.table.table>

        <x-slot name="left_actions">
            <x-admin.v1.buttons.reference-btn btnType="btn-danger waves-effect waves-light"
                                              url="{{route('offers.create')}}">
                <x-slot name="title">
                    <i class="mdi mdi-plus-circle mr-1"></i> {{__('labels.add')}}
                </x-slot>
            </x-admin.v1.buttons.reference-btn>
        </x-slot>

        <x-slot name="right_actions">
            {{--            <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>--}}
            {{--            <button type="button" class="btn btn-light mb-2 mr-1">Import</button>--}}
            {{--            <button type="button" class="btn btn-light mb-2">Export</button>--}}
        </x-slot>
        <x-slot name="headers">
            <th style="width: 20px;">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                </div>
            </th>
            <th>code</th>
            <th>start</th>
            <th>end</th>
            <th>status</th>
            <th>Created at</th>
            <th>Updated aT</th>
            <th style="width: 85px;">Action</th>
        </x-slot>

        <x-slot name="rows">
            @include('admin.v1.offer.partials.rows')
        </x-slot>
        <x-slot name="pagination">
            <x-admin.v1.table.pagination>

                <x-slot name="links">
                    {{$offers->links()}}
                </x-slot>
            </x-admin.v1.table.pagination>
        </x-slot>
    </x-admin.v1.table.table>

@endsection
