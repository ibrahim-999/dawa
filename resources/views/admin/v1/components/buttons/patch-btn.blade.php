<form method="post" enctype="application/x-www-form-urlencoded"
      action="{{$url}}">
    @csrf
    @method('PATCH')
    <div {{$attributes}}>
        <button class="{{'btn  '.$btnType}}"  type="submit">{{$title}}</button>
    </div>
</form>
