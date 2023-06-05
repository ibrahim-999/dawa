@php
    $target=$target ?? null
@endphp
<ul id="myUL">
    <li>
        <span
            class="caret btn-block @if($target?->id == $parent_category->id) btn-success text-white @endif"> {{$parent_category->title}}</span>
        <ul class="nested">
            @foreach($parent_category->childs as $sub_category )
                <li>
                    <span
                        class="caret btn-block @if($target?->id == $sub_category->id) btn-success text-white @endif"> {{$sub_category->title}}</span>
                    <ul class="nested">
                        @foreach($sub_category->childs as $subset_category )
                            <li class="dead-caret btn-block @if($target?->id == $subset_category->id) btn-success text-white @endif "> {{$subset_category->title}}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </li>
</ul>
