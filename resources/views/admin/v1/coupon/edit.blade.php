@extends('admin.v1.layout')
@section('title',__('pages_title.edit_coupon')."|".$coupon->code)
@section('content')
    <x-admin.v1.layout.partials.basic-page-header>
        <x-slot name="breadcrumbs">
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.dashboard')}}" url="{{route('dashboard')}}"
                                                         isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.coupons_index')}}"
                                                         url="{{route('coupons.index')}}" isActive="0"/>
            <x-admin.v1.layout.partials.bread-crumb-item title="{{__('labels.coupons_edit')}}-{{$coupon->code}}" url=""
                                                         isActive="1"/>
        </x-slot>
        <x-slot name="title">
            {{__('texts.coupon_index_header')}}
        </x-slot>
    </x-admin.v1.layout.partials.basic-page-header>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-admin.v1.form.form title="{{__('forms.edit_coupon_title')}} - {{$coupon->code}}"
                                      description="{{__('forms.edit_coupon_description')}}"
                                      url="{{route('coupons.update',$coupon->id)}}"
                                      method="POST" fileable="false">
                    <x-slot name="inputs">
                        <div class="row">
                            <x-admin.v1.form.text-input errorName="" prepend="" value="{{$coupon->code}}" size="col-md-6" name="code"
                            title="{{__('labels.code')}}"
                            placeholder="{{__('placeholders.code')}}"/>
                            <x-admin.v1.form.date-input value="{{$coupon->start_date}}" prepend="" size="col-md-6" name="start_date"
                            title="{{__('labels.start_date')}}"
                            placeholder="{{__('placeholders.start_date')}}"/>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.date-input value="{{$coupon->end_date}}" prepend="" size="col-md-6" name="end_date"
                            title="{{__('labels.end_date')}}"
                            placeholder="{{__('placeholders.end_date')}}"/>

                            <x-admin.v1.form.select-input multiple="0" size="col-md-6" name="discount_type"
                            title="{{__('labels.discount_type')}}">
                            <x-slot name="options">                           
                                <option>Select</option>
                                <option @if($coupon->discount_type == "1") selected
                                    @endif value="{{'1'}}">{{'amount'}}</option>
                                <option @if($coupon->discount_type == "2") selected
                                    @endif value="{{'2'}}">{{'precentage'}}</option>        
                            </x-slot>
                            </x-admin.v1.form.select-input>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{$coupon->discount}}" prepend="" size="col-md-12" name="discount"
                            title="{{__('labels.discount')}}"
                            placeholder="{{__('placeholders.discount')}}"/>
                            
                            <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{$coupon->min_purchases}}" prepend="" size="col-md-12" name="min_purchases"
                            title="{{__('labels.min_purchases')}}"
                            placeholder="{{__('placeholders.min_purchases')}}"/>

                            <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{$coupon->max_discount}}" prepend="" size="col-md-12" name="max_discount"
                            title="{{__('labels.max_discount')}}"
                            placeholder="{{__('placeholders.max_discount')}}"/>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{$coupon->num_uses_person}}" prepend="" size="col-md-6" name="num_uses_person"
                            title="{{__('labels.num_uses_person')}}"
                            placeholder="{{__('placeholders.num_uses_person')}}"/>
                            <x-admin.v1.form.number-input step="0.1"  min="0.1" max="50000" errorName="" value="{{$coupon->num_uses}}" prepend="" size="col-md-6" name="num_uses"
                            title="{{__('labels.num_uses')}}"
                            placeholder="{{__('placeholders.num_uses')}}"/>
                        </div>
                        <div class="row">
                            <x-admin.v1.form.select-input multiple="1" size="col-md-6" name="categories[]"
                            title="{{__('labels.categories')}}">
                            <x-slot name="options">                           
                                <option>Select</option>
                                @foreach ($categories as $category )
                                <option @if($coupon->categories && in_array($category->id,$coupon->categories()->pluck('model_id')->toArray())) selected
                                @endif value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                                {{-- <option @if(old('categories') && in_array('2',old('categories'))) selected
                                    @endif value="{{'2'}}">{{'2'}}</option>         --}}
                            </x-slot>
                            </x-admin.v1.form.select-input>
                        <x-admin.v1.form.select-input multiple="1" size="col-md-6" name="products[]"
                        title="{{__('labels.products')}}">
                        <x-slot name="options">                           
                            <option >Select</option>
                            @foreach ($products as $product )
                            <option @if($coupon->products && in_array($product->id,$coupon->products()->pluck('model_id')->toArray())) selected
                                @endif value="{{$product->id}}">{{$product->title}}</option>
                            @endforeach
                            {{-- <option @if(old('variants') && in_array('2',old('variants'))) selected
                                @endif value="{{'2'}}">{{'2'}}</option>         --}}
                        </x-slot>
                        </x-admin.v1.form.select-input>
                    </div>

                        @method('PATCH')
                    </x-slot>
                    <x-slot name="buttons">
                        <x-admin.v1.buttons.regular-btn btnType="btn-primary" type="submit"
                                                        title="{{__('labels.update')}}"/>
                    </x-slot>
                </x-admin.v1.form.form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    console.log( "ready!" );
    discountType = $('#Id-Discounttype').val();
    // alert(discountType);
    if (discountType == '2') {
        $("#Id-Max_discount").css("display", "block");
        $("#Id-Max_discount").parent().parent().css("display", "block");
    }else{
        $("#Id-Max_discount").val("");
        $("#Id-Max_discount").css("display", "none");
        $("#Id-Max_discount").parent().parent().css("display", "none");
    }

    // $('#Id-Max_discount').val()
});


$("#Id-Discounttype").on('change',function(){
    value = this.value;
    if (value == '2') {
        $("#Id-Max_discount").css("display", "block");
        $("#Id-Max_discount").parent().parent().css("display", "block");
    }else{
        $("#Id-Max_discount").val("");
        $("#Id-Max_discount").css("display", "none");
        $("#Id-Max_discount").parent().parent().css("display", "none");
        // $("#Id-Max_discount").css("display", "block");
    }
});
</script>
@endsection