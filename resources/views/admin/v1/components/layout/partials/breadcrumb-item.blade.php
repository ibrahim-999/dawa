<li class="breadcrumb-item @if($isActive) active @endif">
    @if(!$isActive)
        <a href="{{$url}}">{{$title}}</a>
    @else
        {{$title}}
    @endif
</li>
