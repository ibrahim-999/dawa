<h4 class="header-title">{{$title}}</h4>
<p class="sub-header">{{$description}}</p>
<form class="needs-validation"
      @if($fileable == "true")
          enctype="multipart/form-data"
      @else
          enctype="application/x-www-form-urlencoded"
      @endif
      action="{{$url}}" method="{{$method}}">
    @csrf
    {{$inputs}}
    {{$buttons}}
</form>
