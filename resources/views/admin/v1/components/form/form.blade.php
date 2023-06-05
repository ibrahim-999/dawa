<h4 class="header-title">{{$title}}</h4>
<p class="sub-header">{{$description}}</p>
<form class="needs-validation"
      enctype="@if($fileable == "true") multipart/form-data  @else application/x-www-form-urlencoded @endif"
      action="{{$url}}" method="{{$method}}">
        @csrf
        {{$inputs}}
    {{$buttons}}
</form>

