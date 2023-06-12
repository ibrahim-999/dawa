
<x-admin.v1.buttons.reference-btn btnType="action-icon"
                                  url="{{route('admin.cart.show',['cart'=>$cart->id])}}">
    <x-slot name="title">
        <i class="mdi mdi-eye"></i>
    </x-slot>
</x-admin.v1.buttons.reference-btn>
