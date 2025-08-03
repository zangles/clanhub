<li class="dropdown nav-item">
    <a href="#" class="dropdown-toggle no-caret nav-link cog" data-toggle="dropdown">
        <i class="la la-cog px-2"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        @foreach($dropdownItems as $item)
            @if($item->type === \App\Enums\ConfigItemType::Element)
                <li><a class="dropdown-item" href="{{$item->url}}"><i class="{{$item->iconClass}}"></i> &nbsp; {{$item->title}}</a></li>
            @else
                <li class="dropdown-divider"></li>
            @endif
        @endforeach
    </ul>
</li>
