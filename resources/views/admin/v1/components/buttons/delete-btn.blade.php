<form method="post" enctype="multipart/form-data"
      action="{{$url}}">
    @csrf
    @method('DELETE')
    <div {{$attributes}}>
        <button class="{{'btn  '.$btnType}}"  type="submit">{{$title}}</button>
    </div>
</form>
