<div class="col-md-12">
    <h4 class="header-title">{{__('labels.cart_variants')}}</h4>
</div>

<x-admin.v1.table.table>

    <x-slot name="left_actions">
     </x-slot>

    <x-slot name="right_actions">
        {{--            <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>--}}
        {{--            <button type="button" class="btn btn-light mb-2 mr-1">Import</button>--}}
        {{--            <button type="button" class="btn btn-light mb-2">Export</button>--}}
    </x-slot>
    <x-slot name="headers">
         <th>name</th>
        <th>Price</th>
        <th>Initial Price</th>
        <th>Quantity</th>
        <th>Is Modified</th>
        <th>Modification Type</th>
        <th>Modification value</th>
        <th>Created at</th>
     </x-slot>

    <x-slot name="rows">
        @include('admin.v1.cart.partials.variant.rows')
    </x-slot>
    <x-slot name="pagination">
        <x-admin.v1.table.pagination>

            <x-slot name="links">
{{--                {{$variants->links()}}--}}
            </x-slot>
        </x-admin.v1.table.pagination>
    </x-slot>
</x-admin.v1.table.table>
