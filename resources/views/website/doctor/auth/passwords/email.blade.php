@extends('website.layouts.app')

@section('content')


    <!-- START Page Title -->
    <section id="page-tit"
             style="background: url({!! asset('design/images/bg-main.png') !!}) no-repeat 50% 50%;background-size: cover;">
        <div class="container">
            <div class="page-tit-inner">
                <h1>{{ __('reset password')}}</h1>
            </div>
        </div>
    </section>
    <!-- END Page Title -->
    <!-- START Main Content -->
    <section class="main-content">
        <div id="profile-pg" class="py-5 bg-greyColor6">
            <!-- START Contact Block -->
            <div class="container">
                <div class="doc-single-about doc-single-blk" data-aos="fade-in">
                    <div class="heading-blk text-center mb-3 aos-init aos-animate" data-aos="fade-down">
                        <h5 class="heading-tit-wz-after font-weight-bold">{!! __("reset") !!} <span
                                class="text-secondary">{{ __('your password')}}</span><br><img
                                src="{!! asset('design/images/heading-after.png') !!}"></h5>
                    </div>
                    <div class="pres-form-container text-center">
                        <form method="POST" action="{{ route('doctor.password.email') }}"
                              aria-label="{{ __('Reset Password') }}"
                              class="basic-form form-md form-label-inline m-auto">
                            @csrf

                            <div class="form-group">
                                <label for="">{{ __("email") }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="text-center mt-3">
                                <button
                                    class="btn btn-thirdly text-capitalize">{{ __('Send Password Reset Link') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Contact Block -->
        </div>
    </section>
    <!-- END Main Content -->
@endsection
