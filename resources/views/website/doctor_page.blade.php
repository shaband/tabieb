@extends('website.layouts.app')

@section('title')

    {!! $doctor->name !!}
@endsection



@endpush
@section('content')
    <!-- START Page Title -->
    <section id="page-tit" class="tit-wz-search"
             style="background: url({{asset('design/images/bg-main.png')}}) no-repeat 50% 50%;background-size: cover;">
        <div class="container">
            <div class="page-tit-inner">
                <h1>{{ __('Find your doctor')}}</h1>
                @include('website.partials._search_form')
            </div>
        </div>
    </section>
    <!-- END Page Title -->


    <!-- START Main Content -->
    <section class="main-content">
        <div id="search-single-pg" class="bg-greyColor6 py-5">
            <div class="container">
                <!-- START Single Doctor -->
                <div class="doc-single">
                    <div class="row">
                        <div class="col-lg-7">
                            <!-- START Doctor Information -->
                            <div class="doc-single-dets-blk doc-single-blk" data-aos="fade-in">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="doc-img">
                                            <img src="images/doc-01.png">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-8">
                                        <div class="doc-dets">
                                            <h6 class="doc-n">{!! $doctor->name !!}
                                                @if($doctor->is_active)
                                                    <span class="doc-status active"> {{ __('online now')}}</span>
                                                @endif
                                            </h6>
                                            <div class="doc-s">
                                                {!! $doctor->title !!}
                                            </div>
                                            <div class="doc-rating">
                                                @for($i=1;$i<=5;$i++) <i
                                                    class="fas fa-star @if ($doctor->ratings->avg('rate')>=$i) active @endif">
                                                </i>
                                                @endfor
                                            </div>
                                            <div class="doc-plus-dets">
                                                <div class="doc-price">
                                                    <ins>{!! $doctor->price !!} {{ __('sr/h')}}</ins>
                                                    {{--                                                <del>120 sr/h</del>--}}
                                                </div>
                                                @if($doctor->available!=null)
                                                    <div class="doc-extra-dets">
                                                        <div><img
                                                                src="{{url('design/images/icons/time-date.png')}}"> {{ __('available')}}
                                                            {{$doctor->available_day->format('d-M')}} </div>
                                                        <div><img
                                                                src="{{url('design/images/icons/clock.png')}}"> {{ __('from')}}
                                                            :
                                                            {{optional($doctor->available_time['start'] ?? null)->format('H:i')}} {{ __('to')}}
                                                            :
                                                            {{optional($doctor->available_time['end']?? null)->format('H:i')}}
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="doc-controls">
                                                    <a href="#" class="doc-book-btn btn btn-secondaryLight btn-sm"><img
                                                            src="{{asset('design/images/icons/phone.png')}}">{{ __(' voice call')}}
                                                    </a>
                                                    <a href="#" class="doc-book-btn btn btn-thirdlyLight btn-sm"><img
                                                            src=" {{asset('design/images/icons/video.png')}}"> {{ __('video call')}}
                                                    </a>
                                                    <br>

                                                    <a href="#" class="doc-book-btn btn btn-secondary"><img
                                                            src="{{asset('design/images/icons/phone-White.png')}}"> {{ __('quick call')}}
                                                    </a>
                                                    <a href="#" class="doc-book-btn btn btn-thirdly"><img
                                                            src="{!! asset('design/images/icons/tag.png') !!}"> {{ __('book now')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Doctor Information -->
                                <!-- START About Doctor -->
                                <div class="doc-single-about doc-single-blk" data-aos="fade-in">
                                    <div class="heading-blk mb-2">
                                        <h5 class="heading-tit-wz-after font-weight-bold">{{ __('about')}} <span
                                                class="text-secondary">{{ __('doctor')}}</span><br><img
                                                src="{!! asset('design/images/heading-after.png') !!}"></h5>
                                    </div>
                                    <div class="font-reg">{!! $doctor->description !!}</div>
                                </div>
                                <!-- END About Doctor -->
                                <!-- START Doctor Specialitites -->
                                <div class="doc-single-specialities doc-single-blk" data-aos="fade-in">
                                    <div class="heading-blk mb-2">
                                        <h5 class="heading-tit-wz-after font-weight-bold">{!! __("Doctor") !!} <span
                                                class="text-secondary">{{ __('specialiazations')}}</span><br><img
                                                src="{{asset('design/images/heading-after.png')}}"></h5>
                                    </div>
                                    <div class="doc-badges text-capitalize font-reg">
                                        @foreach($doctor->sub_categories as $sub_category)
                                            <span class="badge">{!! $sub_category->name !!}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- END Doctor Specialitites -->
                                <!-- START Reviews -->
                                <div class="doc-single-clients doc-single-blk" data-aos="fade-in">
                                    <div class="heading-blk mb-2">
                                        <h5 class="heading-tit-wz-after font-weight-bold">{{ __('clients')}} <span
                                                class="text-secondary">{{ __('opinions')}}</span><br><img
                                                src="{{ asset('design/images/heading-after.png')}}"></h5>
                                    </div>
                                    <!-- START Reviews Container -->
                                    <div class="doc-clients font-reg">
                                    @foreach($doctor->ratings as $rating)
                                        <!-- START Review Item -->
                                        <div class="client-op-item">
                                            <div class="client-img">
                                                <img src="{!! optional($rating->patient)->img !!}">
                                            </div>
                                            <div class="client-op-dets font-reg-sm">
                                                <h6 class="client-n">{!! optional($rating->patient)->name !!}</h6>
                                                <div class="client-t-d"><span>{{$rating->created_at->format("H:i A")}}</span> - {{$rating->created_at->format("d-M-Y")}}</div>

                                                <div class="doc-rating client-rating">
                                                    @for($i=1;$i<=5;$i++) <i
                                                        class="fas fa-star @if ($rating->rate->avg('rate')>=$i) active @endif">
                                                    </i>
                                                    @endfor
                                                </div>
                                                <div class="client-op-txt">
                                               {!! $rating->description !!} </div>
                                            </div>
                                        </div>
                                        <!-- END Review Item -->
                                        @endforeach

                                    </div>
                                    <!-- END Reviews Container -->
                                    <!-- START Reviews Form -->
                                    <div class="doc-form-review">
                                        <form action="">
                                            <input class="form-control" type="text"
                                                   placeholder="write your opinion here...">
                                            <button type="button" class="btn"><img src="images/icons/send.png"></button>
                                        </form>
                                    </div>
                                    <!-- END Reviews Form -->
                                </div>
                                <!-- END Reviews -->
                            </div>
                            <div class="col-lg-5">
                                <!-- START Doctor Available Dates and Times Block -->
                                <div class="doc-single-blk" data-aos="fade-in">
                                    <div class="heading-blk mb-2">

                                        <h5 class="heading-tit-wz-after font-weight-bold">appointment <span
                                                class="text-secondary">time</span><br><img
                                                src="images/heading-after.png"></h4>
                                    </div>
                                    <!-- START Doctor Available Dates and Times Container -->
                                    <div class="doc-aval-times">
                                        <div class="owl-carousel">
                                            <!-- START Doctor Available Day Item -->
                                            <div class="item">
                                                <div class="single-day">
                                                    <!-- START Day Date -->
                                                    <div class="single-day-date">sat - 23 sep</div>
                                                    <!-- END Day Date -->
                                                    <!-- START Doctor Available Hours -->
                                                    <div class="single-day-times">
                                                        <!-- START Hour Item -->
                                                        <div class="single-time active"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                    </div>
                                                    <!-- END Doctor Available Hours -->
                                                </div>
                                            </div>
                                            <!-- END Doctor Available Day Item -->
                                            <!-- START Doctor Available Day Item -->
                                            <div class="item">
                                                <div class="single-day">
                                                    <!-- START Day Date -->
                                                    <div class="single-day-date">sat - 23 sep</div>
                                                    <!-- END Day Date -->
                                                    <!-- START Doctor Available Hours -->
                                                    <div class="single-day-times">
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                    </div>
                                                    <!-- END Doctor Available Hours -->
                                                </div>
                                            </div>
                                            <!-- END Doctor Available Day Item -->
                                            <!-- START Doctor Available Day Item -->
                                            <div class="item">
                                                <div class="single-day">
                                                    <!-- START Day Date -->
                                                    <div class="single-day-date">sat - 23 sep</div>
                                                    <!-- END Day Date -->
                                                    <!-- START Doctor Available Hours -->
                                                    <div class="single-day-times">
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                    </div>
                                                    <!-- END Doctor Available Hours -->
                                                </div>
                                            </div>
                                            <!-- END Doctor Available Day Item -->
                                            <!-- START Doctor Available Day Item -->
                                            <div class="item">
                                                <div class="single-day">
                                                    <!-- START Day Date -->
                                                    <div class="single-day-date">sat - 23 sep</div>
                                                    <!-- END Day Date -->
                                                    <!-- START Doctor Available Hours -->
                                                    <div class="single-day-times">
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                    </div>
                                                    <!-- END Doctor Available Hours -->
                                                </div>
                                            </div>
                                            <!-- END Doctor Available Day Item -->
                                            <!-- START Doctor Available Day Item -->
                                            <div class="item">
                                                <div class="single-day">
                                                    <!-- START Day Date -->
                                                    <div class="single-day-date">sat - 23 sep</div>
                                                    <!-- END Day Date -->
                                                    <!-- START Doctor Available Hours -->
                                                    <div class="single-day-times">
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                    </div>
                                                    <!-- END Doctor Available Hours -->
                                                </div>
                                            </div>
                                            <!-- END Doctor Available Day Item -->
                                            <!-- START Doctor Available Day Item -->
                                            <div class="item">
                                                <div class="single-day">
                                                    <!-- START Day Date -->
                                                    <div class="single-day-date">sat - 23 sep</div>
                                                    <!-- END Day Date -->
                                                    <!-- START Doctor Available Hours -->
                                                    <div class="single-day-times">
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                    </div>
                                                    <!-- END Doctor Available Hours -->
                                                </div>
                                            </div>
                                            <!-- END Doctor Available Day Item -->
                                            <!-- START Doctor Available Day Item -->
                                            <div class="item">
                                                <div class="single-day">
                                                    <!-- START Day Date -->
                                                    <div class="single-day-date">sat - 23 sep</div>
                                                    <!-- END Day Date -->
                                                    <!-- START Doctor Available Hours -->
                                                    <div class="single-day-times">
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                        <!-- START Hour Item -->
                                                        <div class="single-time"><span>10: 00 am</span></div>
                                                        <!-- END Hour Item -->
                                                    </div>
                                                    <!-- END Doctor Available Hours -->
                                                </div>
                                            </div>
                                            <!-- END Doctor Available Day Item -->
                                        </div>
                                    </div>
                                    <!-- END Doctor Available Dates and Times Container -->
                                    <div class="doc-appointments-controls mt-3 text-center">
                                        <a href="payment.html" class="btn btn-thirdly btn-sm text-capitalize">book &
                                            proceed to payment</a>
                                    </div>
                                </div>
                                <!-- END Doctor Available Dates and Times Block -->
                            </div>
                        </div>

                    </div>
                    <!-- END Single Doctor -->
                </div>
            </div>
    </section>
    <!-- END Main Content -->
@endsection
