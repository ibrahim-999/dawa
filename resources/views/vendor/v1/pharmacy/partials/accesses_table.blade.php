<div class="col-md-12">
    <h4 class="header-title">{{__('labels.pharmacy_accesses')}}</h4>
</div>

<x-admin.v1.table.table>

    <x-slot name="left_actions">
        @include('admin.v1.pharmacy.partials.accesses.grant-access-form')
    </x-slot>

    <x-slot name="right_actions">
        {{--            <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>--}}
        {{--            <button type="button" class="btn btn-light mb-2 mr-1">Import</button>--}}
        {{--            <button type="button" class="btn btn-light mb-2">Export</button>--}}
    </x-slot>
    <x-slot name="headers">
        <th style="width: 20px;">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">&nbsp;</label>
            </div>
        </th>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th style="width: 85px;">Action</th>
    </x-slot>

    <x-slot name="rows">
        @include('admin.v1.pharmacy.partials.accesses.rows')
    </x-slot>
    <x-slot name="pagination">
    </x-slot>
</x-admin.v1.table.table>
