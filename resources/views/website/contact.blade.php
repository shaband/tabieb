@extends('website.layouts.app')

@section('title')
    {!! __("Contact Us") !!}
@endsection
@section('content')
    @include('website.partials._title_section')



    <!-- START Main Content -->
    <section class="main-content">
        <div id="contact-pg" class="py-5 bg-greyColor6">
            <!-- START Contact Block -->
            <div class="container">
                <div class="doc-single-about doc-single-blk" data-aos="fade-in">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-blk">
                                <div class="heading-blk mb-2">
                                    <h6 class="heading-tit-wz-after font-weight-bold">{!! __("Contact") !!} <span class="text-secondary">{!! __("Us") !!}</span><br><img src="{!! asset('design/images/heading-after.png') !!}"></h6>
                                </div>
                                <form action="" method="post" class="basic-form form-label-inline">
                                    @csrf
                                    @method('post')


                                    <div class="form-group">
                                        <label for="">{{ __('email address')}}:</label>
                                        <input type="email" name="email" class="form-control" placeholder="example@email.com" value="{!! old('email') !!}" required>
                                        @error('message')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group align-items-start">
                                        <label for="">{{ __('message')}}:</label>
                                        <textarea  name="message" required class="form-control">{!! old('message') !!}</textarea>
                                        @error('message')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="text-center px-3">
                                        <button class="btn btn-lg btn-thirdly text-capitalize w-100">{!! __("Send") !!}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-blk">
                                <div class="heading-blk mb-2">
                                    <h6 class="heading-tit-wz-after font-weight-bold">{!! __("Contact Us") !!} <span class="text-secondary">{!! __("On") !!}</span><br><img src="{!! asset('design/images/heading-after.png') !!}"></h6>
                                </div>
                                <div class="contact-data">
                                    <div><i class="fas fa-phone text-secondary"></i
                                        > {!! $settings['phone 1'] !!}</div>
                                    <div><i class="fas fa-phone text-secondary"></i> {!! $settings['phone 2'] !!}</div>
                                </div>
                                <div class="heading-blk mb-2 mt-4">
                                    <h6 class="heading-tit-wz-after font-weight-bold">{!! __("Follow us") !!}  <span class="text-secondary">{!! __("On") !!}</span><br><img src="{!! asset('design/images/heading-after.png') !!}"></h6>
                                </div>
                                <div class="footer-social social-blk">
                                    <a href="{!! $settings['facebook Link'] !!}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{!! $settings['twitter Link'] !!}"><i class="fab fa-twitter"></i></a>
                                    <a href=" {!! $settings['snapchat Link'] !!}"><i class="fab fa-snapchat-ghost"></i></a>
                                </div>
                                <div class="heading-blk mb-2 mt-4">
                                    <h6 class="heading-tit-wz-after font-weight-bold">{!! __("Our") !!} <span class="text-secondary">{!! __("Location") !!}</span><br><img src="{!! asset("design/images/heading-after.png") !!} "></h6>
                                </div>
                                <div class="locations-blk">
                                    <div class="location-item">
                                        <div><i class="fa fa-map-marker-alt text-secondary"></i></div>
                                        <div class="text-capitalize">
                                            <p class="mb-1">{!! $settings['address_'.app()->getLocale()] !!}</p>
{{--
                                            <a href="#" target="_blank" class="btn btn-secondaryLight2 btn-sm text-capitalize">show on map</a>
--}}
                                        </div>
                                    </div>
                                </div>
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
