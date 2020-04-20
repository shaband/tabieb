<li class="nav-item nav-item-wz-sub">
    <a class="nav-link" href="javascript:void(0)"><i
            class="fas fa-user"></i> {!! auth()->guard('patient')->user()->user_name !!}</a>
    <ul>
        <li class="{!! setActive('patient.profile.medicalHistory') !!}"><a
                href="{!! route('patient.profile.medicalHistory') !!}">{{ __('personal information')}}</a>
        </li>
        <li class="{!! setActive('patient.profile.appointments') !!}">
            <a href="{!! route('patient.profile.appointments') !!}">{{ __('appointments')}}</a>
        </li>
        <li class="{!! setActive('patient.profile.history') !!} ">
            <a href="{!! route('patient.profile.history') !!}">{{ __('history')}}</a>
        </li>
        <li class="{!! setActive('patient.profile.change-password') !!}">
            <a href="{!! route('patient.profile.change-password') !!}">
                {{ __("change password")}}
            </a>
        </li>
        <li><a href="{{ route('patient.logout') }}" class="text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('logout') }}</a>
        </li>


        <form id="logout-form" action="{{ route('patient.logout') }}" method="POST"
              style="display: none;">
            {!! csrf_field() !!}
        </form>

    </ul>
</li>
