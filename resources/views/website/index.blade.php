@extends('website.layouts.app')


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
                <div class="intro-search" data-delay="2000" data-aos="fade-up">
                    <form class="form-secondary">
                        <div class="row align-items-end justify-content-center">
                            <div class="col-sm-6 col-md-3 col-lg">
                                <div class="form-group">
                                    <label for="">{!! __("search by name") !!}</label>
                                    <input type="text" class="form-control" name="doctor_name"
                                           placeholder="search by name">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg">
                                <div class="form-group">
                                    <label for="">{!!  __("select specialities") !!}</label>
                                    <select class="form-control bootstrap-select" name="category_id">
                                        @foreach($categories as $key=>$category)
                                            <option value="{!! $key !!}">{!! $category !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg">
                                <div class="form-group">
                                    <label for="">{{ __('available time from')}}</label>
                                    <input type="time" name="from_time" class="form-control " placeholder="pick time">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg">
                                <div class="form-group">
                                    <label for="">{{ __('available time to')}}</label>
                                    <input type="time" name="to_time" class="form-control " placeholder="pick time">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg">
                                <div class="search-confirm">
                                    <button type="button"
                                            class="btn bg-primary-gradient-x text-white w-100">{{ __('Search now')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
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
                                        <img src="{!! url($doctor->img) !!}">
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
                                        <div class="doc-extra-dets">
                                            <div><img src="{!! asset('design/images/icons/time-date.png')!!}">
                                                {{ __('Available on')}}: 23 sep
                                            </div>
                                            <div><img src="{!! asset('design/images/icons/clock.png') !!}">
                                                from: 12:45
                                                to:
                                                5:50
                                            </div>
                                        </div>
                                        <a href="#"
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
                        <!-- START Features Block -->
                        <div class="col-md-6">
                            <!-- START Features Container -->
                            <div class="features-blk text-white py-5">
                                <!-- START Feature Item -->
                                <div class="feature-item" data-aos="fade-in">
                                    <div class="feature-icon"><img src="{!! asset('design/images/icons/doctor.png')!!}"
                                                                   alt=""></div>
                                    <h5 class="feature-tit">{!! __("Our Vision") !!}</h5>

                                    <div class="feature-desc">{!! $settings["vision_".app()->getLocale()] !!}</div>
                                </div>
                                <!-- END Feature Item -->
                                <!-- START Feature Item -->
                                <div class="feature-item" data-aos="fade-in">
                                    <div class="feature-icon"><i class="fas fa-user-md"></i></div>
                                    <h5 class="feature-tit">{!! __("Our Idea") !!}</h5>
                                    <div class="feature-desc">{!! $settings["idea_".app()->getLocale()] !!} </div>
                                </div>
                                <!-- END Feature Item -->
                                <!-- START Feature Item -->
                                <div class="feature-item" data-aos="fade-in">
                                    <div class="feature-icon"><img src="{!! asset('design') !!}/images/icons/doctor.png"
                                                                   alt=""></div>
                                    <h5 class="feature-tit">{!! __("Our Goal") !!}</h5>
                                    <div class="feature-desc">{!! $settings["goal_".app()->getLocale()] !!}</div>
                                </div>
                                <!-- END Feature Item -->
                            </div>
                            <!-- END Features Container -->
                        </div>
                        <!-- END Features Block -->
                        <!-- START Why To choose us Block -->
                        <div class="col-md-6">
                            <div class="desc-blk py-5">
                                <div class="heading-blk mb-4" data-aos="fade-down">
                                    <h3 class="heading-tit-wz-after font-weight-bold">{{ __('why you have to choose')}},
                                        <br> {{ __('trust
                                        our services')}} <img src="{!! asset('design/images/heading-after.png') !!}">
                                    </h3>
                                </div>
                                <p class="font-reg-sm text-justify mb-4"
                                   data-aos="fade-in">{!! substr($settings['about_'.app()->getLocale()],0,500) !!}</p>
                                <a href="{{--{!! route('about') !!}--}}"
                                   class="text-capitalize link-secondary link-wz-icon" data-aos="fade-up">{{ __('more
                                    about us')}} <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!-- END Why To choose us Block -->
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
                            <h3 class="heading-tit-wz-after font-weight-bold">download our application <br> to book
                                easily <img src="{!! asset('design') !!}/images/heading-after.png"></h3>
                        </div>
                        <!-- END Block Heading -->
                        <p class="font-reg-sm text-justify mb-4" data-aos="fade-in">

                            {!! substr($settings['download_description_'.app()->getLocale()],0,732)  !!}
                        </p>
                        <div class="apps-blk" data-aos="fade-in">
                            <a href="{!! $settings['andriod_link'] !!}"><img src="{!! asset('design') !!}/images/btn-apple.png" alt=""></a>
                            <a href="{!! $settings['ios_link'] !!}"><img src="{!! asset('design') !!}/images/btn-google.png" alt=""></a>
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
