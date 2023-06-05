<div class="card-box">
    <div class="media mb-3">
        <img class="d-flex mr-3 rounded-circle avatar-lg" src="{{asset('admin-panel-assets/v1')}}/images/companies/amazon.png" alt="Generic placeholder image">
        <div class="media-body">
            <h4 class="mt-0 mb-1">{{$product->title}}</h4>
            <p class="text-muted">
                @if($product->is_active)
                    <span class="badge bg-success text-white">{{__('labels.active')}}</span>

                @else
                    <span class="badge bg-danger text-white">{{__('labels.inactive')}}</span>

                @endif

            </p>
        </div>
    </div>
    <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> {{__('labels.product_info')}}</h5>
    <div class="">
        <h4 class="font-13 text-muted text-uppercase">{{__('labels.info')}}</h4>
        @if($product->category)
            <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.category')}} :</h4>
            <p class="mb-3"> {{$product->category->title}}</p>
        @endif

        @if($product->sub_category)
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.sub_category')}} :</h4>
        <p class="mb-3"> {{$product->sub_category->title}}</p>
        @endif
        @if($product->subset_category)
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.sub_category')}} :</h4>
        <p class="mb-3"> {{$product->subset_category->title}}</p>
        @endif
        @if($product->brand)
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.brand')}} :</h4>
        <p class="mb-3"> {{$product->brand->title}}</p>
        @endif
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.created_at')}} :</h4>
        <p class="mb-3"> {{$product->created_at}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.updated_at')}} :</h4>
        <p class="mb-3"> {{$product->updated_at}}
    </div>

</div>
