<nav id="sidebar" class="sidebar" role="navigation" >
    <!-- need this .js class to initiate slimscroll -->
    <div class="js-sidebar-content">
        <header class="logo d-none d-md-block">
            <a href="../dashboard/index.html"><span class="fw-thin">{{config('app.name')}}</span></a>
        </header>
{{--        <h5 class="sidebar-nav-title">Gremios</h5>--}}
        <ul class="sidebar-nav">
            @foreach($menu as $menuItem)
                <x-layout.menu.menu-item :dto="$menuItem"/>
            @endforeach
        </ul>

        <x-layout.menu.sidebarAlerts.container :title="'Alertas'" :alerts="$alerts" />
    </div>
</nav>
