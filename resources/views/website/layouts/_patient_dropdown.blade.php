<li class="nav-item nav-item-wz-sub">
    <a class="nav-link" href="javascript:void(0)"><i
            class="fas fa-user"></i> {!! auth()->guard('patient')->user()->user_name !!}</a>
    <ul>
        <li class="active"><a
                href="profile-personal-info.html">{{ __('personal information')}}</a>
        </li>
        <li><a href="profile-appointments.html">{{ __('appointments')}}</a></li>
        <li><a href="profile-history.html">{{ __('history')}}</a></li>
        <li><a href="profile-password.html">{{ __("change password")}}</a></li>
        <li><a href="{{ route('patient.logout') }}" class="text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('logout') }}</a>
        </li>


        <form id="logout-form" action="{{ route('patient.logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>

    </ul>
</li>
