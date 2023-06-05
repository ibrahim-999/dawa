
<ul id="myUL" style=" height: inherit; position: absolute; margin-right: 20px">
    @foreach($categories as $category )
    <li>
        <span class="caret btn-block btn-primary text-white"> {{$category->title}}</span>
        <ul class="nested">
            @foreach($category->childs as $sub_category )
            <li>
                <span class="caret btn-block btn-secondary text-white"> {{$sub_category->title}}</span>
                <ul class="nested">
                    @foreach($sub_category->childs as $subset_category )
                    <li class="dead-caret btn-block btn-success text-white"> {{$subset_category->title}}</li>
                    @endforeach
               </ul>
            </li>
            @endforeach
        </ul>
    </li>
    @endforeach
</ul>
