@extends('website.layouts.app')

@section('title')
    {!! __("Terms & Conditions") !!}
@endsection
@section('content')
    @include('website.partials._title_section')
    <!-- START Main Content -->
    <section class="main-content">
        <div id="search-single-pg">
            <!-- START About Block 1 -->
            <div class="about-blk-1 py-5 bg-greyColor6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="heading-blk mb-2" data-aos="fade-down">
                                <h5 class="heading-tit-wz-after font-weight-bold">
                                    {!! __("Terms & Conditions") !!} </h5>
                            </div>
                            <p> {!! $settings["policy_".app()->getLocale()] !!}</p>
                        </div>
                        <div class="col-md-5">
                            <img class="w-100" src="{!! asset("design/images/bg-main.png") !!}" alt=""
                                 data-aos="zoom-in">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END About Block 1 -->
        {{--            @include('website.partials._info_section')--}}


        <!-- START About Block 2 -->
            <div id="h-why" class="spilitted-blk">
                <!-- START Backgrounds of the 2 Blocks -->
                <!-- Don't Change Any Thing around Start and End of This block -->
                <div class="bgs-blk">
                    <div class="row">
                        <div class="col-md-6 bg-secondary features-bg"
                             style="background: url( {!! asset('design/images/bg-pattern.png') !!}) repeat;background-size: 400px;"></div>
                        <div class="col-md-6"
                             style="background: url({!! asset('design/images/bg-lines.png') !!}) no-repeat;background-size: 100% auto;"></div>
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
            <!-- END About Block 2 -->
        </div>

    </section>
    <!-- END Main Content -->
@endsection
