<div class="col-md-12">
    <h4 class="header-title">{{__('labels.buy_variants')}}</h4>
</div>

<x-admin.v1.table.table>

    <x-slot name="left_actions">
    </x-slot>
    <x-slot name="right_actions">
    </x-slot>
    <x-slot name="headers">
        <th>name</th>
        <th>Price</th>
        <th>Status</th>
        <th>qty</th>
    </x-slot>

    <x-slot name="rows">
        @include('admin.v1.offer.partials.variant_rows',['variant' => $offer->buyVariants->first(),'qty' => $offer->buy_amount])
    </x-slot>
    <x-slot name="pagination">
    </x-slot>
</x-admin.v1.table.table>

<div class="col-md-12">
    <h4 class="header-title">{{__('labels.get_variants')}}</h4>
</div>

<x-admin.v1.table.table>

    <x-slot name="left_actions">
    </x-slot>
    <x-slot name="right_actions">
    </x-slot>
    <x-slot name="headers">
        <th>name</th>
        <th>Price</th>
        <th>Status</th>
        <th>qty</th>
    </x-slot>

    <x-slot name="rows">
        @include('admin.v1.offer.partials.variant_rows',['variant' => $offer->getVariants->first(),'qty' => $offer->get_amount])
    </x-slot>
    <x-slot name="pagination">
    </x-slot>
</x-admin.v1.table.table>


