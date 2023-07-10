<div class="card-box">
    <div class="media mb-3">
        <img class="d-flex mr-3 rounded-circle avatar-lg" src="{{ $variant->main_image}}">
        <div class="media-body">
            <h4 class="mt-0 mb-1">{{$variant->title}}</h4>
            <p class="text-muted">
                @if($variant->is_active)
                    <span class="badge bg-success text-white">{{__('labels.active')}}</span>

                @else
                    <span class="badge bg-danger text-white">{{__('labels.inactive')}}</span>

                @endif

            </p>
        </div>
    </div>
    <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="fa fa-product-hunt"></i> {{__('labels.variant_info')}}</h5>
    <div class="">
        <h4 class="font-13 text-muted text-uppercase">{{__('labels.info')}}</h4>
        @if($variant?->product?->category)
            <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.category')}} :</h4>
            <p class="mb-3"> {{$variant->product->category->title}}</p>
        @endif

        @if($variant?->product?->sub_category)
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.sub_category')}} :</h4>
        <p class="mb-3"> {{$variant->product->sub_category->title}}</p>
        @endif
        @if($variant?->product?->subset_category)
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.sub_category')}} :</h4>
        <p class="mb-3"> {{$variant->product->subset_category->title}}</p>
        @endif
        @if($variant?->product?->brand)
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.brand')}} :</h4>
        <p class="mb-3"> {{$variant->product->brand->title}}</p>
        @endif
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.price')}} :</h4>
        <p class="mb-3"> {{$variant->price}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.discount')}} :</h4>
        <p class="mb-3"> {{$variant->discount_percentage}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.net_price')}} :</h4>
        <p class="mb-3"> {{$variant->net_price}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.created_at')}} :</h4>
        <p class="mb-3"> {{$variant->created_at}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.updated_at')}} :</h4>
        <p class="mb-3"> {{$variant->updated_at}}
    </div>

</div>