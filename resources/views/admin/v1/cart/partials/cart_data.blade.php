<div class="card-box">
     <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i
            class="mdi mdi-account-circle mr-1"></i> {{__('labels.cart_info')}}</h5>
    <div class="">
        <h4 class="font-13 text-muted text-uppercase">{{__('labels.info')}}</h4>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.name')}} :</h4>
        <p class="mb-3">   {{$cart->user->name??'-'}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.email')}} :</h4>
        <p class="mb-3">  {{$cart->user->email??'-'}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.phone')}} :</h4>
        <p class="mb-3">   {{$cart->user->phone??'-'}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.address')}} :</h4>
        <p class="mb-3">  {{$cart->address->address??'-'}}</p>
        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('labels.created_at')}} :</h4>
        <p class="mb-3"> {{$cart->created_at}}</p>
    </div>

</div>
