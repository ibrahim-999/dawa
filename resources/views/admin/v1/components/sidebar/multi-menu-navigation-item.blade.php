<li>
    <a href="#sidebarMultilevel{{ucfirst($name)}}" data-toggle="collapse">
        <i data-feather="share-2"></i>
        <span> {{$title}} </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebarMultilevel{{ucfirst($name)}}">
        <ul class="nav-second-level">
            {{ $items}}
        </ul>
    </div>
</li>