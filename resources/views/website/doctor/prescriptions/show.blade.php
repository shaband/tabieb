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
                @include('website.doctor.prescriptions._prescription')
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



