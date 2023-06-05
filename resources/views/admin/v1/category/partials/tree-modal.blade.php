
<x-admin.v1.buttons.modal-btn class="btn btn-sm btn-success" target="CategoryTree{{$category->id}}">
    <x-slot name="icon">
        <i class="fa fa-tree"></i>
    </x-slot>
    <x-slot name="modal">
        <x-admin.v1.modals.actions.submit-or-cancel classes="" id="CategoryTree{{$category->id}}"
                                                    header="{{__('texts.category_tree',['name'=>$category->title])}}">
            <x-slot name="body">
                @include('admin.v1.category.partials.single-tree',['parent_category'=>$category->tree_start,'target'=>$category])
            </x-slot>
            <x-slot name="actionBtns">
            </x-slot>
        </x-admin.v1.modals.actions.submit-or-cancel>

    </x-slot>
</x-admin.v1.buttons.modal-btn>
