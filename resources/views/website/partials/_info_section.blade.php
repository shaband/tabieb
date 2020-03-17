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
           data-aos="fade-in">{!! substr($settings['why_us_'.app()->getLocale()],0,500) !!}</p>
        @if(!request()->routeIs('about'))

        <a href="{!! route('about') !!}"
           class="text-capitalize link-secondary link-wz-icon" data-aos="fade-up">{{ __('more about us')}} <i
                class="fas fa-arrow-right"></i></a>
        @endif
    </div>
</div>
<!-- END Why To choose us Block -->
