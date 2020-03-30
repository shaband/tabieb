<li class="nav-item nav-item-wz-sub">
    <a class="nav-link" href="javascript:void(0)"><i
            class="fas fa-user"></i> {!! auth()->guard('doctor')->user()->name !!}</a>
    <ul>
        <li class=""><a
                href="">{{ __('personal information')}}</a>
        </li>
        <li class="{!! setActive('doctor.profile.appointments') !!}">
            <a href="{!! route('doctor.profile.appointments') !!}">{{ __('my appointments')}}</a>
        </li>
        <li class="{!! setActive('doctor.profile.documents') !!}">
            <a href="{!! route('doctor.profile.documents') !!}">{{ __('my medical documents')}}</a>
        </li>
        <li class="{!! setActive('doctor.profile.history') !!}"><a
                href="{!! route('doctor.profile.history') !!}">{{ __('my history')}}</a>
        </li>
        <li class="{!! setActive('doctor.profile.change-password') !!}">
            <a href="{!! route('doctor.profile.change-password') !!}">{{ __('change password')}}</a>
        </li>
        <li><a href="javascript:void(0)">
                <div class="prof-doc-stat">
                    <div><span class="text-primary">{{ __('status')}}:</span> <span
                            class="doc-stat">{{ __('Not Active')}}</span></div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input"
                               id="doctorStatusSwitch2">
                        <label class="custom-control-label"
                               for="doctorStatusSwitch2"></label>
                    </div>
                </div>
            </a></li>
        <li>
            <a href="{{ route('doctor.logout') }}" class="text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('logout') }}</a>
        </li>
        <li>

            <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST"
                  style="display: none;">
                {!! csrf_field() !!}
            </form>
        </li>
    </ul>
</li>

