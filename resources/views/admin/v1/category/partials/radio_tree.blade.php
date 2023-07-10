@php
$selected=$selected ?? old('category_id');
@endphp

<div class="invalid-feedback" style="display: block" >
    @error('category_id')
    {{$message}}
    @enderror
</div>
<ul id="myUL" style=" height: inherit; position: absolute; margin-right: 20px">
    @foreach($categories as $category )
        <li>

        <span class="caret btn-block btn-primary text-white" style="height: fit-content">

        <label for="{{'Id-'.ucfirst($category->title)}}">{{$category->title}}</label>
        <input type="radio" value="{{$category->id}}" name="category_id" @if($selected==$category->id) checked
               @endif id="{{'Id-'.ucfirst($category->title)}}">
        </span>
            <ul class="nested">
                @foreach($category->childs as $sub_category )
                    <li>
        <span class="caret btn-block btn-secondary text-white" style="height: fit-content">

        <label for="{{'Id-'.ucfirst($sub_category->title)}}">{{$sub_category->title}}</label>
        <input type="radio" value="{{$sub_category->id}}" name="category_id" @if($selected==$sub_category->id) checked
               @endif id="{{'Id-'.ucfirst($sub_category->title)}}">
        </span>
                        <ul class="nested">
                            @foreach($sub_category->childs as $subset_category )

                                <li class="dead-caret btn-block btn-success text-white " style="height: fit-content">
                                <label
                                    for="{{'Id-'.ucfirst($subset_category->title)}}">{{$subset_category->title}}</label>
                                <input type="radio" value="{{$subset_category->id}}" name="category_id" @if($selected==$sub_category->id) checked
                                       @endif id="{{'Id-'.ucfirst($subset_category->title)}}">
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>

