@extends('website.layouts.app')
{{--
@push('header')
    <style>


        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }


        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
            content: '\f005';
            font-family: Font Awesome 5 Free;
        }

        .rev-box {
            overflow: hidden;
            height: 0;
            width: 100%;
            transition: all .25s;
        }

        textarea.review {
            width: 100%;
        }

        label.review {
            display: block;
            transition: opacity .25s;
        }


        input.star:checked ~ .rev-box {
            height: 125px;
            overflow: visible;
        }

    </style>
@endpush
--}}
@section('title')
    {!! env("APP_NAME",'tabayib') !!}
@endsection
@section('content')

    <!-- START Home Page Intro -->
    <section id="home-intro"
             style="background: url({!! asset('design/images/bg-main.png')!!}) no-repeat 50% 50%;background-size: cover;">
        <div class="container">
            <div class="intro-inner">
                <div class="intro-header text-white text-capitalize text-center">
                    <h2 class="font-weight-bold" data-delay="1000" data-aos="flip-up">{!! __("Find & book your ") !!}
                        <span
                            class="text-secondary"> {!! __("favourite doctor") !!}</span></h2>
                    <h5 class="font-weight-bold" data-delay="1500" data-aos="fade-in">
                        {!! __("have a video/voice call") !!} </h5>
                </div>
                @include('website.partials._search_form')            </div>
        </div>
    </section>
    <!-- END Home Page Intro -->
    <!-- START Main Content -->
    <section class="main-content">
        <!-- START Doctors Block -->
        <div id="h-docs" class="bg-secondaryLight py-5">
            <div class="container">
                <!-- START Block Heading -->
                <div class="heading-blk text-center mb-5" data-aos="fade-down">
                    <h4 class="heading-tit-wz-after font-weight-bold">{!! __("Public") !!} <span
                            class="text-secondary">{!! __("Doctors") !!}</span><br>
                        <img src="{!! asset('design/images/heading-after.png') !!}"></h4>
                </div>
                <!-- END Block Heading -->
                <!-- START Doctors Container -->
                <div class="docs-container">
                    <div class="row">
                    @foreach($doctors as $doctor)


                        <!-- START Doctor Item -->
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="doc-item" data-aos="fade-in">
                                    <div class="doc-img">
                                        <img src="{!! asset($doctor->img) !!}">
                                        <div class="doc-price">{!! $doctor->price !!} {!! __("rs/h") !!}</div>
                                    </div>
                                    <div class="doc-dets">
                                        <h6 class="doc-n">{!! $doctor->name !!}</h6>
                                        <div class="doc-s">{!! $doctor->title !!}</div>
                                        <div class="doc-rating">
                                            @for($i=1;$i<=5;$i++)
                                                <i class="fas fa-star @if ($doctor->ratings->avg('rate')>=$i) active @endif"></i>
                                            @endfor
                                        </div>
                                        @if($doctor->available!=null)
                                            <div class="doc-extra-dets">
                                                <div><img
                                                        src="{{url('design/images/icons/time-date.png')}}"> {{ __('available')}}
                                                    {{$doctor->available_day->format('d-M')}} </div>
                                                <div><img
                                                        src="{{url('design/images/icons/clock.png')}}"> {{ __('from')}}:
                                                    {{optional($doctor->available_time['start'] ?? null)->format('H:i')}} {{ __('to')}}
                                                    :
                                                    {{optional($doctor->available_time['end']?? null)->format('H:i')}}
                                                </div>
                                            </div>
                                        @endif
                                        <a href="{!! route('reservation.doctor',$doctor->id) !!}"
                                           class="doc-book-btn btn btn-secondary btn-sm">{!! __("Book Now") !!}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END Doctor Item -->
                        @endforeach

                    </div>
                </div>
                <!-- END Doctors Container -->
            </div>
        </div>
        <!-- END Doctors Block -->
        <!-- START Features and Why To choose us Block -->
        <div id="h-why" class="spilitted-blk">
            <!-- START Backgrounds of the 2 Blocks -->
            <!-- Don't Change Any Thing around Start and End of This block -->
            <div class="bgs-blk">
                <div class="row">
                    <div class="col-md-6 bg-secondary features-bg"
                         style="background: url({!! asset('design/images/bg-pattern.png') !!}) repeat;background-size: 400px;"></div>
                    <div class="col-md-6"
                         style="background: url({!! asset('design/images/bg-lines.png') !!} ) no-repeat;background-size: 100% auto;"></div>
                </div>
            </div>
            <!-- END Backgrounds of the 2 Blocks  -->
            <!-- START The 2 Blocks -->
            <div>
                <div class="container">
                    <div class="row align-items-center">
                        @include('website.partials._info_section')
                    </div>
                </div>
            </div>
            <!-- END The 2 Blocks -->
        </div>
        <!-- END Features and Why To choose us Block -->
        <!-- START Booking Steps Block -->
        <div id="h-book" class="bg-secondaryLight pt-5">
            <div class="container">
                <!-- START Block Heading -->
                <div class="heading-blk text-center mb-5" data-aos="fade-down">
                    <h3 class="heading-tit-wz-after font-weight-bold">{!! __("how to book with tabaieb?") !!}<br><img
                            src="{!! asset('design/images/heading-after.png') !!}"></h3>
                </div>
                <!-- END Block Heading -->
                <!-- START Booking Steps -->
                <div id="booking-steps" class="features-blk features-blk-2 py-5">
                    <div class="row justify-content-between">
                        <!-- START Booking Step item -->
                        <div class="col-md-4 col-lg-3">
                            <div class="feature-item" data-aos="zoom-in">
                                <div class="feature-num">1</div>
                                <div class="feature-icon"><img class="w-100"
                                                               src="{!! asset('design') !!}/images/icons/search.png">
                                </div>
                                <h5 class="feature-tit">{{ __('search')}}</h5>
                                <div class="feature-desc">
                                    {!! substr($settings['search_box_'.app()->getLocale()],0,34)!!}
                                </div>
                            </div>
                        </div>
                        <!-- END Booking Step item -->
                        <!-- START Booking Step item -->
                        <div class="col-md-4 col-lg-3">
                            <div class="feature-item feature-special" data-aos="zoom-in">
                                <div class="feature-num">2</div>
                                <div class="feature-icon"><img class="w-100"
                                                               src="{!! asset('design') !!}/images/icons/value.png">
                                </div>
                                <h5 class="feature-tit">{{ __('compare & choose')}}</h5>
                                <div
                                    class="feature-desc">{!! substr($settings['compare_box_'.app()->getLocale()],0,34)!!}</div>
                            </div>
                        </div>
                        <!-- END Booking Step item -->
                        <!-- START Booking Step item -->
                        <div class="col-md-4 col-lg-3">
                            <div class="feature-item" data-aos="zoom-in">
                                <div class="feature-num">3</div>
                                <div class="feature-icon"><img class="w-100"
                                                               src="{!! asset('design') !!}/images/icons/calendar.png">
                                </div>
                                <h5 class="feature-tit">{{ __('booking')}}</h5>
                                <div
                                    class="feature-desc">{!! substr($settings['book_box_'.app()->getLocale()],0,34)  !!}</div>
                            </div>
                        </div>
                        <!-- END Booking Step item -->
                    </div>
                </div>
                <!-- END Booking Steps -->
            </div>
        </div>
        <!-- END Booking Steps Block -->
        <!-- START Download Our Apps Block -->
        <div id="h-download" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-8">
                        <!-- START Block Heading -->
                        <div class="heading-blk mb-4" data-aos="fade-down">
                            <h3 class="heading-tit-wz-after font-weight-bold">{{ __('download our application')}} <br> {{ __('to book
                                easily')}} <img src="{!! asset('design') !!}/images/heading-after.png"></h3>
                        </div>
                        <!-- END Block Heading -->
                        <p class="font-reg-sm text-justify mb-4" data-aos="fade-in">

                            {!! substr($settings['download_description_'.app()->getLocale()],0,732)  !!}
                        </p>
                        <div class="apps-blk" data-aos="fade-in">
                            <a href="{!! $settings['andriod_link'] !!}"><img
                                    src="{!! asset('design') !!}/images/btn-apple.png" alt=""></a>
                            <a href="{!! $settings['ios_link'] !!}"><img
                                    src="{!! asset('design') !!}/images/btn-google.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-4 app-img">
                        <img class="w-100" src="{!! asset('design') !!}/images/app.png" data-aos="zoom-in">
                    </div>
                </div>
            </div>
        </div>
        <!-- END Download Our Apps Block -->
    </section>
    <!-- END Main Content -->
@endsection
