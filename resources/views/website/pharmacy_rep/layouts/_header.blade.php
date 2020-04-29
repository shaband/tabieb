<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">


        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{!! asset(auth()->user()->img) !!}" alt="user-image"
                     class="rounded-circle">
                <span class="pro-user-name ml-1">
                                {!! auth()->user()->name !!} <i class="mdi mdi-chevron-down"></i>
                            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">{!! __("Welcome !") !!}</h6>
                </div>
                <!-- item-->
                <a href="{!! route('pharmacy.pharmacy-reps.edit',auth()->id()) !!}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span> {!! __("My Account") !!}</span>
                </a>


                <div class="dropdown-divider"></div>

                <!-- item-->
                <a class="dropdown-item notify-item" href="{{ route('pharmacy.logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fe-log-out"></i>
                    <span>{!!  __("Logout")!!}</span>
                </a>
                <form id="logout-form" action="{{ route('pharmacy.logout') }}" method="POST" style="display: none;">
                    {!! csrf_field() !!}
                </form>
            </div>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{!! route('pharmacy.dashboard') !!}" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{!! asset('dashboard/logo.png') !!}" alt="">
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">X</span> -->
                            <img src="{!! asset('dashboard/logo.png') !!}" alt="">
                        </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <h4 class="page-title-main"> @yield('title') </h4>
        </li>

    </ul>
</div>
