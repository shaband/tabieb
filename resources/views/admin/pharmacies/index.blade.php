@extends('admin.layouts.app')
@section('title') {!! __("Pharmacies") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>
                @can('Create Pharmacy')

                <div class="mt-0 header-title float-right  d-inline">

                    <a class="btn btn-info text-white" href="{!! route('admin.pharmacies.create') !!}">
                        <i class="fas fa-plus"></i> {!! __("New")!!}</a>
                </div>
                @endcan
                <div class="pt-4">


                    <nav>
                        <div class="nav nav-tabs" id="pharmacies-tab" role="tablist">
                            <a class="nav-item nav-link active" id="open-pharmacies-tab" data-toggle="tab"
                               href="#open-pharmacy" role="tab" aria-controls="open-pharmacy"
                               aria-selected="true">{!! __("Open Pharmacies") !!}</a>
                            <a class="nav-item nav-link" id="sub-cat-tab" data-toggle="tab" href="#blocked-pharmacy"
                               role="tab" aria-controls="blocked-pharmacy"
                               aria-selected="false">{!! __("Blocked Pharmacies") !!}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="pharmacies-tabContent">
                        <div class="tab-pane fade show active" id="open-pharmacy" role="tabpanel"
                             aria-labelledby="open-pharmacies-tab">

                            @include('admin.pharmacies._table',['pharmacies'=>$open_pharmacies])


                        </div>
                        <div class="tab-pane fade" id="blocked-pharmacy" role="tabpanel" aria-labelledby="sub-cat-tab">

                            @include('admin.pharmacies._table',['pharmacies'=>$blocked_pharmacies])

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
