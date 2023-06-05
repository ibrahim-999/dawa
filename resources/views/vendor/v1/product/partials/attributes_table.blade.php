<div class="col-md-12">
    <h4 class="header-title">{{__('labels.product_attributes')}}</h4>
</div>

<x-admin.v1.table.foo-table>

    <x-slot name="left_actions">
        @include('admin.v1.product.partials.attributes.add')
    </x-slot>

    <x-slot name="right_actions">
        {{--            <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>--}}
        {{--            <button type="button" class="btn btn-light mb-2 mr-1">Import</button>--}}
        {{--            <button type="button" class="btn btn-light mb-2">Export</button>--}}
    </x-slot>
    <x-slot name="headers">
        <th style="width: 20px;" >
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="attributesCheckAll">
                <label class="custom-control-label" for="attributesCheckAll">&nbsp;#</label>
            </div>
        </th>
        <th data-toggle="true">name</th>
        <th data-hide="phone">Status</th>
        <th data-hide="all"> Values </th>
        <th>Action</th>
    </x-slot>

    <x-slot name="rows">
        @include('admin.v1.product.partials.attributes.rows')
    </x-slot>
    <x-slot name="pagination">
        <x-admin.v1.table.pagination>

            <x-slot name="links">
{{--                {{$attributes->links()}}--}}
            </x-slot>
        </x-admin.v1.table.pagination>
    </x-slot>
</x-admin.v1.table.foo-table>
