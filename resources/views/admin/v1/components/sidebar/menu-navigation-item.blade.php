<li>
    <a href="#sidebar{{ucfirst($name)}}" data-toggle="collapse" class="" aria-expanded="true">
        {{$icon}}
        <span>  {{$title}} </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebar{{ucfirst($name)}}" style="">
        <ul class="nav-second-level">
            {{ $items}}
        </ul>
    </div>
</li>
