@extends('website.layouts.app')
@push('header')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
            integrity="sha256-FzNq4zk/v9wI609QPrquqvvW/uHDAo2nhBRZY+mhh/4=" crossorigin="anonymous"></script>
@endpush

@section('title')

    {!! __("Prescription")  !!}

@endsection
@section('content')
    @include('website.partials._title_section')
    <!-- START Main Content -->
    <section class="main-content">
        <div id="prescription-pg" class="py-5 bg-greyColor6">
            <!-- START Contact Block -->
            <div class="container">
                <div class="prescription-container" id="prescription-container">
                    <div class="pres-header">
                        <div class="pres-logo">
                            <img class="w-100" src="{{asset($prescription->doctor->logo)}}">
                        </div>
                        <div class="pres-main-dets">
                            <div class="d-name">{!! $prescription->doctor->name !!}</div>
                            <div class="d-title text-secondary">{!! $prescription->doctor->title !!}</div>
                            <div class="d-desc text-light">{!! $prescription->doctor->description !!}</div>
                        </div>
                    </div>
                    <div class="pres-sub-header">
                        <table>
                            <tr>
                                <th>{{ __('patient name')}}:</th>
                                <td>{!! $prescription->patient->name !!}</td>
                            </tr>
                            <tr>
                                <th>age:</th>
                                <td>{!! $prescription->patient->birthdate ? \Carbon\Carbon::now()->diffInYears($prescription->patient->birthdate) : null !!}</td>
                            </tr>
                            <tr>
                                <th>date:</th>
                                <td>{!! $prescription->created_at->format("Y-m-d") !!}</td>
                            </tr>
                            <tr>
                                <th>desease:</th>
                                <td>{!! $prescription->diagnosis !!}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="pres-desc font-weight-bold">
                        {!! $prescription->description !!}
                    </div>
                    <div class="pres-content">
                        <table class="table table-striped m-0">
                            <tbody>
                            <tr>
                                <th>{{ __('Medicine')}}</th>
                                <th>{{ __('Dose')}}</th>
                                <th>{{ __('Note')}}</th>
                            </tr>
                            @foreach($prescription->items  ??[] as $item)
                                <tr>
                                    <th>{!! $item->medicine !!}</th>
                                    <th>{!! $item->dose !!}</th>
                                    <th>{!! $item->description !!}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <img class="pres-bottom" src="{{asset('design/images/sharasheeb.png')}}">
                </div>
                <div class="text-center mt-5">
                    <a href="javascript:void(0)" class="btn btn-thirdly btn-lg text-capitalize px-5 font-weight-bold"><i
                            class="fas fa-print"></i> {{__('print now')}}</a>
                </div>
            </div>
            <!-- END Contact Block -->
        </div>
    </section>
    <!-- END Main Content -->

@endsection

@push('scripts')
    <script>
        function printPrescription() {
            $('#prescription-container').printThis({
                base: "{!! request()->url() !!}"
            })
        }
    </script>
@endpush



