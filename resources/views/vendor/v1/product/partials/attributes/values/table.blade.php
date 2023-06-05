
    <x-admin.v1.table.table>

        <x-slot name="left_actions">
            @include('admin.v1.product.partials.attributes.values.add')
        </x-slot>

        <x-slot name="right_actions">
        </x-slot>
        <x-slot name="headers">
            <th style="width: 20px;" >
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="AttributeValueCheckAll-{{$attribute->id}}">
                    <label class="custom-control-label" for="AttributeValueCheckAll-{{$attribute->id}}">&nbsp;#</label>
                </div>
            </th>
            <th>Code</th>
            <th>Name En</th>
            <th>Name Ar</th>
            <th style="width: 85px;">Action</th>
        </x-slot>

        <x-slot name="rows">
            @foreach($attribute->values as $value)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="attributeValueCheck{{$value->id}}">
                            <label class="custom-control-label" for="attributeValueCheck{{$value->id}}">{{$loop->iteration}}</label>
                        </div>
                    </td>
                    <td>
                        {{$value->code}}
                    </td>
                    <td>
                        {{$value->translate('en')->name}}
                    </td>
                    <td>
                        {{$value->translate('ar')->name}}
                    </td>
                    <td>
                        @include('admin.v1.product.partials.attributes.values.action-btns')
                    </td>
                </tr>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
        </x-slot>
    </x-admin.v1.table.table>

