<nav class="page-controls navbar navbar-dashboard">
    <div class="container-fluid">

        <!-- this part is hidden for xs screens -->
        <div class="navbar-header mobile-hidden">
            <ul class="nav navbar-nav float-right">
                <li class="dropdown nav-item">
                    <a href="#" role="button" class="nav-link small"  aria-haspopup="true" aria-expanded="false" data-position="bottom-middle-aligned" data-disable-interaction="false">
                            <span class="thumb-sm avatar float-left">
{{--                                <img class="rounded-circle" src="../demo/img/people/a5.jpg" alt="...">--}}
                            </span>
                        &nbsp;
                        Usuario01
                        &nbsp;
{{--                        <span class="circle bg-primary text-white fs-sm fw-bold">15</span>--}}
                    </a>
                </li>
                <li class="nav-item divider d-none d-xl-block"></li>
                <x-layout.navbar.config-btn />
                <li class="nav-item d-none d-xl-block">
                    <a target="_self" href="../extra/login.html" class="nav-link">
                        <i class="la la-power-off px-2"></i>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a target="_self" class="nav-link" data-toggle="collapse" href="#sidebar" role="button" aria-expanded="true" aria-controls="collapseExample">
                        <i class="la la-navicon"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
