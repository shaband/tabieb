@extends('website.pharmacy_rep.layouts.app')

@section('title') {!! __("Prescription") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>


                <div class="mt-0 header-title float-right d-inline">


                </div>
                <div class="pt-4">

                    @includeWhen(isset($prescription) &&!empty($prescription),'website.pharmacy_rep.prescriptions.show')
                </div>
            </div>
        </div>
    </div>


@endsection
