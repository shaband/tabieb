<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{!! auth()->user()->img !!}" alt="user-img" title="Mat Helme"
                 class="rounded-circle img-thumbnail avatar-lg">
            <div class="dropdown">
                <a href="#" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                   data-toggle="dropdown">{!! auth()->guard('admin')->user()->name !!}</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>{!! __("My Account") !!}</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                       class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>{!! __("Logout") !!}</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">{!! __("Admin Head") !!}</p>

        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title"> {!! __("Navigation") !!}</li>

                <li>
                    <a href="{!! route('admin.dashboard') !!}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> {!! __('Dashboard') !!} </span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-invert-colors"></i>
                        <span> {!! __("Admins") !!} </span>
                        <span class="menu-arrow"></span>
                        {{--
                                                <span class="badge badge-warning float-right">7</span>
                        --}}

                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!! route('admin.admins.index') !!}">{!! __("Admins List") !!}</a></li>
                        <li><a href="{!! route('admin.admins.create') !!}">{!! __("Add New") !!}</a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-invert-colors"></i>
                        <span> {!! __("Categories") !!} </span>
                        <span class="menu-arrow"></span>
                        {{--
                                                <span class="badge badge-warning float-right">7</span>
                        --}}

                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!! route('admin.categories.index') !!}">{!! __("Categories List") !!}</a></li>
                        <li><a href="{!! route('admin.categories.create') !!}">{!! __("Add New") !!}</a></li>

                    </ul>
                </li>


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
