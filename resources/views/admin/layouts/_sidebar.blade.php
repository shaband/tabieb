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
                <li>
                    <a href="{!! route('admin.admins.index') !!}">
                        <i class="fab fa-black-tie"></i>
                        <span> {!! __('Admins') !!} </span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.categories.index') !!}">
                        <i class=" fas fa-boxes"></i>
                        <span> {!! __('Categories') !!} </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-users-cog"></i>
                        <span>{!! __("Student Settings") !!}</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level nav" aria-expanded="false">
                        {{--   <li>
                               <a href="javascript: void(0);">{!! __("Students") !!}</a>
                           </li>--}}


                        <li>
                            <a href="{!! route('admin.questions.index') !!}">
                                <i class="fas fa-question pr-1"></i>

                                {!! __("Question") !!}</a>


                            <a href="{!! route('admin.social-securities.index') !!}">
                                <i class=" fas fa-user-shield pr-1"></i>

                                {!! __("Social Securities") !!}</a>

                            <a href="{!! route('admin.patient-questions.index') !!}">

                                <i class=" fas fa-question-circle pr-1"></i>

                                {!! __("Patient Question") !!}</a>
                        </li>
                        <li>

                            <a href="javascript: void(0);" aria-expanded="false">

                                <i class=" fas fa-archway pr-1"></i>

                                {!! __("Places") !!}
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">


                                <li>
                                    <a href="{!! route('admin.districts.index') !!}">{!! __("Districts") !!}</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.areas.index') !!}">{!! __("Areas") !!}</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.blocks.index') !!}">{!! __("Blocks") !!}</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>