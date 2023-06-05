<div class="card-box">
    <div class="media mb-3">
        <img class="d-flex mr-3 rounded-circle avatar-lg" src="{{asset('admin-panel-assets/v1')}}/images/companies/amazon.png" alt="Generic placeholder image">
        <div class="media-body">
            <h4 class="mt-0 mb-1">{{$pharmacy->name}}</h4>
            <p class="text-muted">
                @if($pharmacy->chain)
                    {{__('labels.chain')}} : {{$pharmacy->chain->name}}
                @else
                    {{__('labels.separated')}}
                @endif

            </p>
        </div>
    </div>
    <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> {{__('labels.pharmacy_info')}}</h5>
    <div class="">
        <h4 class="font-13 text-muted text-uppercase">{{__('labels.info')}}</h4>
        <p class="mb-3 text-wrap text-break">
            {{$pharmacy->info}}
        </p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.created_at')}} :</h4>
        <p class="mb-3"> {{$pharmacy->created_at}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.updated_at')}} :</h4>
        <p class="mb-3"> {{$pharmacy->updated_at}}
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.accesses_num')}} :</h4>
        <p class="mb-3"> {{$accesses->count()}}</p>
    </div>

</div>
