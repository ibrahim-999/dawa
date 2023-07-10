@extends('admin.v1.layout')
@section('title')
    {{__('pages_title.create_admin')}}
@endsection
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.activities_index')}}" url="" isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.activities_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>

    <x-admin.v1.table.table>

        <x-slot name="left_actions">
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
            <th>Log Name</th>
            <th>Description</th>
            <th>Subject Type</th>
            <th>Properties</th>
        </x-slot>

        <x-slot name="rows">
            @include('admin.v1.activity.partials.rows')
        </x-slot>
        <x-slot name="pagination">
            <x-admin.v1.table.pagination>

                <x-slot name="links">
                    {{--{{$activities->links()}}--}}
                </x-slot>
            </x-admin.v1.table.pagination>
        </x-slot>
    </x-admin.v1.table.table>

@endsection
