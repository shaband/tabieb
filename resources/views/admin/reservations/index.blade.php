@extends('admin.layouts.app')
@section('title') {!! __("Reservations") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>
                <div class="mt-0 header-title float-right  d-inline">

                    <a class="btn btn-info text-white" href="{!! route('admin.reservations.create') !!}">
                        <i class="fas fa-plus"></i> {!! __("New")!!}</a>
                </div>
                <div class="pt-4">


                    <nav>
                        <div class="nav nav-tabs" id="reservations-tab" role="tablist">
                            <a class="nav-item nav-link active" id="open-reservations-tab" data-toggle="tab"
                               href="#open-reservation" role="tab" aria-controls="open-reservation"
                               aria-selected="true">{!! __("Open Reservations") !!}</a>
                            <a class="nav-item nav-link" id="sub-cat-tab" data-toggle="tab" href="#blocked-reservation"
                               role="tab" aria-controls="blocked-reservation"
                               aria-selected="false">{!! __("Blocked Reservations") !!}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="reservations-tabContent">
                        <div class="tab-pane fade show active" id="open-reservation" role="tabpanel"
                             aria-labelledby="open-reservations-tab">

                            @include('admin.reservations._table',['reservations'=>$open_reservations])


                        </div>
                        <div class="tab-pane fade" id="blocked-reservation" role="tabpanel" aria-labelledby="sub-cat-tab">

                            @include('admin.reservations._table',['reservations'=>$blocked_reservations])

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
