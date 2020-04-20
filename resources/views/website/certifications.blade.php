@extends('website.layouts.app')

@section('title')

    {!! __("Certifications")  !!}

@endsection
@section('content')

    @include('website.partials._title_section')

    <!-- START Main Content -->
    <section class="main-content">
        <div class="py-5 bg-greyColor6">
            <div class="container">
                <div class="doc-single-about doc-single-blk" {{--data-aos="fade-in"--}}>
                    <div class="prescriptions-container">
                        <div class="row">
                            @forelse($certifications as $certification)

                                <div class="col-sm-6 col-md-4">
                                    <div class="cert-item">
                                        <h6 class="font-weight-bold">{{$certification->name}}</h6>

                                        @if($certification->file!=null)
                                            <div class="cert-link">
                                                <a href="{{asset($certification->file)}}"
                                                   class="text-secondary text-capitalize"
                                                   target="_blank">{{ __('show file now')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty


                                <div
                                    class="d-flex justify-content-center bd-highlight mb-3 w-100">
                                    {{ __("There is No Certifications For This Doctor")}}

                                </div>

                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END Main Content -->

@endsection


