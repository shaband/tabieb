@extends('admin.layouts.app')
@section('title') {!! __("Patients") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>
                @can('Create Patient')

                <div class="mt-0 header-title float-right  d-inline">

                    <a class="btn btn-info text-white" href="{!! route('admin.patients.create') !!}">
                        <i class="fas fa-plus"></i> {!! __("New")!!}</a>
                </div>
                @endcan
                <div class="pt-4">


                    <nav>
                        <div class="nav nav-tabs" id="patients-tab" role="tablist">
                            <a class="nav-item nav-link active" id="open-patients-tab" data-toggle="tab"
                               href="#open-patient" role="tab" aria-controls="open-patient"
                               aria-selected="true">{!! __("Open Patients") !!}</a>
                            <a class="nav-item nav-link" id="sub-cat-tab" data-toggle="tab" href="#blocked-patient"
                               role="tab" aria-controls="blocked-patient"
                               aria-selected="false">{!! __("Blocked Patients") !!}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="patients-tabContent">
                        <div class="tab-pane fade show active" id="open-patient" role="tabpanel"
                             aria-labelledby="open-patients-tab">

                            @include('admin.patients._table',['patients'=>$open_patients])


                        </div>
                        <div class="tab-pane fade" id="blocked-patient" role="tabpanel" aria-labelledby="sub-cat-tab">

                            @include('admin.patients._table',['patients'=>$blocked_patients])

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
