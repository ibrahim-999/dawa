@extends('admin.v1.layout')
@section('title',__('pages_title.show_category')."|".$category->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.categories_index')}}"
                                                         url="{{route('categories.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.categories_show')}}-{{$category->name}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.categories_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="row">

        <div class="col-lg-4">
            <!-- end card-box-->
            @include('admin.v1.category.partials.category_data')
        </div>
    </div>
@endsection
