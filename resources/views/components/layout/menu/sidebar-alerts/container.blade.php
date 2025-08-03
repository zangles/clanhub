{{--<h5 class="sidebar-nav-title">Alertas</h5>--}}
<div class="sidebar-abajo">
    <h5 class="sidebar-nav-title">{!! $title !!}</h5>
    <div class="sidebar-alerts"  >
        @foreach($alerts as $alert)
            <x-layout.menu.sidebarAlerts.alert :dto="$alert" />
        @endforeach
    </div>
</div>

