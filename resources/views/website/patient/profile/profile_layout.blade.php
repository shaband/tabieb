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
                                    <div><a href="profile-edit.html" class="btn btn-secondaryLight2 btn-sm"><i
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
                                        <li class="active"><a
                                                href="profile-personal-info.html">{{ __('personal information')}}</a>
                                        </li>
                                        <li><a href="profile-appointments.html">{{ __('my appointments')}}</a></li>
                                        <li><a href="profile-history.html">{{ __('my history')}}</a></li>
                                        <li><a href="profile-password.html">{{ __('change password')}}</a></li>
                                        {{--                                        <li><a class="text-danger" href="#">{{ __('log out')}}</a></li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="profile-body">
                                <div class="heading-blk mb-2">
                                    <h5 class="heading-tit-wz-after font-weight-bold">{{ __('edit')}} <span
                                            class="text-secondary">{{ __('information')}}</span><br><img
                                            src="{{asset($user->img)}}"></h5>
                                </div>
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
