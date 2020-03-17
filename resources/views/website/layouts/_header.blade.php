<!-- START Page Header -->
<header id="main-header">
    <div id="header-wrap">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <div class="d-flex align-items-center">
                    <a id="navbar-toggler-lnk" href="javascript:void(0)" class="btn text-secondary"
                       onclick="mobOpenMainMenu()">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <a class="navbar-brand" href="{!! route('home') !!}"><img src="{!! asset('design/images/logo.png') !!}"
                                                                         alt="Tabaieb Logo"></a>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <a id="navbar-close-lnk" onclick="mobCloseMainMenu()"><i class="fas fa-times-circle"></i></a>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{!! url('/') !!}">{!! __("Home") !!}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" {{--href="appointments.html"--}}>{{ __('My Appointments')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('about')}}">{{ __('about tabaieb')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route("contact.show") !!}">{{ __('contact us')}}</a>
                        </li>
                    </ul>
                </div>

                <div class="extra-links">
                    <ul class="navbar-nav">
                        {{--<li class="nav-item">
                            <a class="nav-link" href="search.html"><i class="fas fa-search"></i> search</a>
                        </li>--}}
                        <li class="nav-item">
                            <ul>
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                    {{-- @dump($localeCode,App()->getLocale(),$localeCode != App()->getLocale())
                                    --}} @if($localeCode !=App()->getLocale())
                                        <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}"
                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            <i class="fas fa-globe"></i> {{ $properties['native'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </ul>

                        </li>
                        @if(auth()->guard('patient')->guest() && auth()->guard('doctor')->guest())
                            <li class="nav-item">
                                <a class="login-btn nav-link" href="javascript:void(0)">{!! __("Login") !!}</a>
                            </li>
                        @elseif(auth()->guard('patient')->check())
                            @include('website.layouts._patient_dropdown')
                        @elseif(auth()->guard('doctor')->check())

                            @include('website.layouts._doctor_dropdown')
                        @endif
                        <li class="nav-item nav-item-wz-sub">
                            <a class="nav-link user-self" href="javascript:void(0)"><i class="fas fa-bell"></i></a>
                            <ul>
                                <li>
                                    <a href="#">
                                        <div class="notif-item">
                                            <div class="notif-icon"><img src="images/notification1.png"></div>
                                            <div class="notif-dets">
                                                <p>you have an appointment today at <span
                                                        class="text-secondary">09:00PM</span>
                                                </p>
                                                <p><i class="far fa-clock"></i> 12:00AM</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="notif-item">
                                            <div class="notif-icon"><img src="images/notification2.png"></div>
                                            <div class="notif-dets">
                                                <p>you have a new important notification from tabaieb</p>
                                                <p><i class="far fa-clock"></i> 12:00AM</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="notif-item">
                                            <div class="notif-icon"><img src="images/notification3.png"></div>
                                            <div class="notif-dets">
                                                <p>Dr. Mohamed Omar accepted your booking</p>
                                                <p><i class="far fa-clock"></i> 12:00AM</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="notif-item">
                                            <div class="notif-icon"><img src="images/notification4.png"></div>
                                            <div class="notif-dets">
                                                <p>you have a new important notification from tabaieb</p>
                                                <p><i class="far fa-clock"></i> 12:00AM</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link user-self active" href="inbox.html"><i
                                    class="fas fa-envelope"></i></a>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>

</header>
<!-- END Page Header -->


<div class="modals-container">
    <!-- START Login Modal -->
    <div class="modal fade reg-modal" tabindex="-1" id="loginModal" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="reg-modal-col reg-modal-col-1">
                            <div class="modal-close">
                                <a href="javascript:void(0)" class="text-light" data-dismiss="modal"
                                   aria-label="Close"><i class="far fa-times-circle"></i></a>
                            </div>
                            <div class="heading-blk mb-3" data-aos="fade-down">
                                <h5 class="heading-tit-wz-after font-weight-bold">{!! __("Hi") !!} <span
                                        class="text-secondary">{{ __('login now')}}</span><br><img
                                        src="{!! asset('design/images/heading-after.png') !!}"></h5>
                            </div>
                            <div class="nav nav-pills text-capitalize justify-content-center mb-3" id="v-pills-tab"
                                 role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-doctor-tab" data-toggle="pill"
                                   href="#v-pills-doctor" role="tab" aria-controls="v-pills-doctor"
                                   aria-selected="true">{{ __('doctor')}}</a>
                                <a class="nav-link" id="v-pills-patient-tab" data-toggle="pill"
                                   href="#v-pills-patient" role="tab" aria-controls="v-pills-patient"
                                   aria-selected="false">{{ __('patient')}}</a>
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-doctor" role="tabpanel"
                                     aria-labelledby="v-pills-doctor-tab">
                                    <form action="{!! route('doctor.login') !!}" method="post"
                                          class="basic-form form-label-inline form-secondaryLight">
                                        @csrf
                                        @method('post')
                                        <div class="form-group">
                                            <label for="">{{ __('email address')}}:</label>
                                            <input type="email" name="email" class="form-control">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="">{{ __('password')}}:</label>
                                            <input type="password" name="password" class="form-control">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>
                                        <div>
                                            <a href="{{route('doctor.password.request')}}"
                                               class="text-secondary text-capitalize mb-3 d-block">{{ __('forget your password?')}}</a>
                                        </div>
                                        <div class="mb-1 text-center">
                                            <button class="btn btn-thirdly text-capitalize">{{ __('login')}}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="v-pills-patient" role="tabpanel"
                                     aria-labelledby="v-pills-patient-tab">
                                    <form action="{!! route('patient.login') !!}" method="post"
                                          class="basic-form form-label-inline form-secondaryLight">
                                        @csrf
                                        @method('post')
                                        <div class="form-group">
                                            <label for="">{{ __('email address')}}:</label>
                                            <input type="email" name="email" class="form-control">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">{{ __('password')}}:</label>
                                            <input type="password" name="password" class="form-control">
                                            @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div>
                                            <a href="{{route('patient.password.request')}}"
                                               class="text-secondary text-capitalize mb-3 d-block">{{ __('forget your password?')}}</a>
                                        </div>
                                        <div class="mb-1 text-center">
                                            <button class="btn btn-thirdly text-capitalize">{{ __('login')}}</button>
                                        </div>
                                    </form>
                                    <div class="mb-3 text-center font-weight-bold">
                                        {{__(" Don't have an account?")}} <a href="javascript:void(0)" id="register-btn"
                                                                             class="text-secondary text-capitalize">{{ __("sign up")}}</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="reg-modal-col reg-modal-col-2 bg-secondary">
                            <img src="{!! asset('design/images/logo-white.png') !!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Login Modal -->
    <!-- START Register Modal -->
    <div class="modal fade reg-modal" tabindex="-1" id="registerModal" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="reg-modal-col reg-modal-col-1">
                            <div class="modal-close">
                                <a href="javascript:void(0)" class="text-light" data-dismiss="modal"
                                   aria-label="Close"><i class="far fa-times-circle"></i></a>
                            </div>
                            <div class="heading-blk mb-3" data-aos="fade-down">
                                <h5 class="heading-tit-wz-after font-weight-bold">{{ __('hi')}}, <span
                                        class="text-secondary">{{ __("let's create an account")}}</span><br><img
                                        src="{!! asset('design/images/heading-after.png') !!}"></h5>
                            </div>
                            <form method="post" action="{{route('patient.register')}}"
                                  class="basic-form form-label-inline form-secondaryLight">
                                @method('post')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ __('first name')}}:</label>
                                            <input type="text" name="first_name" value="{{old('first_name')}}"
                                                   class="form-control">
                                            @error('first_name')
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ __('last name')}}:</label>
                                            <input type="text" name="last_name" value="{{old('last_name')}}"
                                                   class="form-control">
                                            @error('last_name')
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">{{ __('email address')}}:</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                                    @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{ __('phone number')}}:</label>
                                    <input type="number" name="phone" class="form-control" value="{{old('phone')}}">
                                    @error('phone')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{ __('password')}}:</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{ __('confirm password')}}:</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                <div class="mb-1 text-center">
                                    <button class="btn btn-thirdly text-capitalize">{{ __('Register')}}</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="reg-modal-col reg-modal-col-2 bg-secondary">
                            <img src="{!! asset('design/images/logo-white.png') !!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Register Modal -->
</div>
