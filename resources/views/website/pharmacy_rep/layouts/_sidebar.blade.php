<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{!! asset(auth()->user()->img )!!}" alt="user-img" title="Mat Helme"
                 class="rounded-circle img-thumbnail avatar-lg">
            <div class="dropdown">
                <a href="{!! route('pharmacy.pharmacy-reps.edit',auth()->id()) !!}"
                   class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                   data-toggle="dropdown">{!! auth()->guard('pharmacy_rep')->user()->name !!}</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>{!! __("My Account") !!}</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('pharmacy.logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                       class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>{!! __("Logout") !!}</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">{!! optional(auth()->user())->role==1?__("Manger"):__("Rep")!!}</p>

        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title"> {!! __("Navigation") !!}</li>

                <li>
                    <a href="{!! route('pharmacy.dashboard') !!}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> {!! __('Dashboard') !!} </span>
                    </a>
                </li>

                @if(auth()->user()->role==1)

                <li>
                    <a href="{!! route('pharmacy.prescriptions.index') !!}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> {!! __('Prescriptions') !!} </span>
                    </a>
                </li>

                @endif

                @if(auth()->user()->role==1)
                    <li>
                        <a href="{!! route('pharmacy.pharmacy-reps.index') !!}">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span> {!! __('Pharmacy Reps') !!} </span>
                        </a>
                    </li>
                @endif

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
