@extends('website.pharmacy_rep.layouts.app')

@section('title') {!! __("Pharmacy Reps") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>


                    <div class="mt-0 header-title float-right d-inline">

                        <a class="btn btn-info text-white" href="{!! route('pharmacy.pharmacy-reps.create') !!}">
                            <i class="fas fa-plus"></i> {!! __("New")!!}</a>
                    </div>
                <div class="pt-4">

                    @include('website.pharmacy_rep.pharmacy_reps._table')
                </div>
            </div>
        </div>
    </div>


@endsection
