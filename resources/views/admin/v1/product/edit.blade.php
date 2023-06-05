@extends('admin.v1.layout')
@section('title',__('pages_title.edit_product')."|".$product->name)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.products_index')}}"
                                                         url="{{route('products.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.products_edit')}}-{{$product->name}}"
                                                         url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.products_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>


    <div class="card">
        <div class="card-body">
            <x-admin.v1.form.form title="{{__('forms.edit_product_title')}}-{{$product->name}}"
                                  description="{{__('forms.edit_product_description')}}"
                                  url="{{route('products.update',$product->id)}}"
                                  method="POST" fileable="false">
                <x-slot name="inputs">
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-3 card-box p-3" style=" overflow: auto;">
                            <h4 class="text-dark header-title m-t-0 m-b-30">{{__('labels.categories_tree')}}</h4>

                            @php
                                if ($product->subset_category)
                                {
                                    $selected_category=$product->subset_category->id;
                                }
                                elseif ($product->sub_category)
                                {

                                    $selected_category=$product->sub_category->id;

                                }
                                else
                                {
                                    $selected_category=$product->category->id;
                                }
                            @endphp
                            @include('admin.v1.category.partials.radio_tree',['categories'=>$categories,'selected'=> $selected_category])
                        </div>


                        <div class="col-md-9">
                            @foreach(config('translatable.locales') as $local)
                                <div class="col-md-12">
                                    <h5>{{__('labels.language')}}-{{ucfirst($local)}}</h5>
                                </div>
                                <x-admin.v1.form.text-input errorName="" prepend=""
                                                            value="{{$product->translate($local)->title}}"
                                                            size="col-md-12"
                                                            name="{{$local}}[title]"
                                                            title="{{__('labels.title',['local'=>$local])}}"
                                                            placeholder="{{__('placeholders.title',['local'=>$local])}}"/>
                                <x-admin.v1.form.text-area-input prepend=""
                                                                 value="{{$product->translate($local)->description}}"
                                                                 length="500"
                                                                 rows="4" size="col-md-12"
                                                                 name="{{$local}}[description]"
                                                                 title="{{__('labels.description')}}"
                                                                 placeholder="{{__('placeholders.description')}}"/>
                            @endforeach
                            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="brand_id"
                                                          title="{{__('labels.brand_id')}}">
                                <x-slot name="options">
                                    <option value="">{{__('labels.brand_id')}}</option>
                                    @foreach($brands as $id => $name)
                                        <option @if($product->brand_id == $id)
                                                    selected
                                                @endif value="{{$id}}">{{$name}}
                                        </option>
                                    @endforeach
                                </x-slot>
                            </x-admin.v1.form.select-input>


                        </div>

                    </div>


                    <x-slot name="buttons">
                        <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                        title="{{__('labels.create')}}"/>
                    </x-slot>

                </x-slot>
                <x-slot name="buttons">
                    <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                    title="{{__('labels.update')}}"/>
                </x-slot>
            </x-admin.v1.form.form>
        </div>
    </div>

@endsection
