@extends('website.layouts.app')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('content')


    @include('website.partials._title_section')
    <!-- START Main Content -->
    <section class="main-content">
        <div id="profile-pg" class="py-5 bg-greyColor6">
            <!-- START Contact Block -->
            <div class="container">
                <div class="doc-single-about doc-single-blk" data-aos="fade-in">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="profile-side">
                                <div class="user-dets">
                                    <div><a href="{!! route('doctor.profile.edit') !!}"
                                            class="btn btn-secondaryLight2 btn-sm"><i
                                                class="fas fa-pencil-alt"></i></a></div>
                                    <div class="user-img"><img src="{!! asset($user->img) !!}"></div>
                                    <div class="user-info">
                                        <div class="user-n">{!! $user->name !!}</div>
                                        <div class="user-m text-light">{!! $user->email !!}</div>
                                        {{-- <div class="user-w text-thirdly"><img src="images/icons/wallet.png" > 2546 RS</div>--}}
                                    </div>
                                </div>
                                <div class="user-list">
                                    <ul>
                                        <li class=""><a
                                                href="">{{ __('personal information')}}</a>
                                        </li>
                                        <li class="{!! setActive('doctor.profile.appointments') !!}">
                                            <a href="{!! route('doctor.profile.appointments') !!}">{{ __('my appointments')}}</a>
                                        </li>
                                        <li class="{!! setActive('doctor.profile.history') !!}"><a
                                                href="{!! route('doctor.profile.history') !!}">{{ __('my history')}}</a>
                                        </li>
                                        <li class="{!! setActive('doctor.profile.change-password') !!}">
                                            <a href="{!! route('doctor.profile.change-password') !!}">{{ __('change password')}}</a>
                                        </li>
                                        <li><a class="text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('logout') }}
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="profile-body">

                                @yield('form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Contact Block -->
        </div>
    </section>
    <!-- END Main Content -->
@endsection
