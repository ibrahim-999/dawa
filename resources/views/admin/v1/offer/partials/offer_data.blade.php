<div class="card-box">
    <div class="media mb-3">
        <img class="d-flex mr-3 rounded-circle avatar-lg" src="{{asset('admin-panel-assets/v1')}}/images/companies/amazon.png" alt="Generic placeholder image">
        <div class="media-body">
            <h4 class="mt-0 mb-1">{{$offer->title}}</h4>
        </div>
    </div>
    <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> {{__('labels.offer_info')}}</h5>
    <div class="">
        <h4 class="font-13 text-muted text-uppercase">{{__('labels.info')}}</h4>
        <p class="mb-3 text-wrap text-break">
            {{$offer->description}}
        </p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.start_date')}} :</h4>
        <p class="mb-3"> {{$offer->start_date}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.end_date')}} :</h4>
        <p class="mb-3"> {{$offer->end_date}}
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.created_at')}} :</h4>
        <p class="mb-3"> {{$offer->created_at}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.updated_at')}} :</h4>
        <p class="mb-3"> {{$offer->updated_at}}
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.is_active')}} :</h4>
        @if($offer->is_active)
            <span class="badge bg-soft-success text-success">{{__('labels.active')}}</span>

        @else
            <span class="badge bg-soft-danger text-danger">{{__('labels.inactive')}}</span>

        @endif
    </div>

</div>
