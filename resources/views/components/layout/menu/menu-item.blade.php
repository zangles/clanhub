@php
    $random = random_int(1,999999);
@endphp
<li class="@if($dto->isActive()) active @endif">
    <a
        @if($dto->hasSubmenu)
            class="collapsed" href="#a{{$random}}-core" data-toggle="collapse" data-parent="#sidebar" @if($dto->isActive()) aria-expanded="true" @endif
        @else
            href="{{$dto->url}}"
        @endif
    >
        @if($dto->iconClass <> '')
            <span class="icon">
                <i class="{{$dto->iconClass}}"></i>
            </span>
        @endif
        {{$dto->title}}
        @if($dto->hasSubmenu)
            <i class="toggle fa fa-angle-down"></i>
        @endif
    </a>
    @if($dto->hasSubmenu)
        <ul id="a{{$random}}-core" class="collapse @if($dto->isActive()) show @endif">
            @foreach ($dto->submenu as $subMenuDto)
                <x-layout.menu.sub-menu-item :dto="$subMenuDto"/>
            @endforeach
        </ul>
    @endif
</li>
