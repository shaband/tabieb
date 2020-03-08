@extends('admin.layouts.app')
@section('title') {!! __("Districts") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>
                @can('Create District')
                <div class="mt-0 header-title float-right  d-inline">

                    <a class="btn btn-info text-white" href="{!! route('admin.districts.create') !!}">
                        <i class="fas fa-plus"></i> {!! __("New")!!}</a>
                </div>
                @endcan
                <div class="pt-4">


                    <nav>
                        <div class="nav nav-tabs" id="districts-tab" role="tablist">
                            <a class="nav-item nav-link active" id="open-districts-tab" data-toggle="tab"
                               href="#open-district" role="tab" aria-controls="open-district"
                               aria-selected="true">{!! __("Open Districts") !!}</a>
                            <a class="nav-item nav-link" id="sub-cat-tab" data-toggle="tab" href="#blocked-district"
                               role="tab" aria-controls="blocked-district"
                               aria-selected="false">{!! __("Blocked Districts") !!}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="districts-tabContent">
                        <div class="tab-pane fade show active" id="open-district" role="tabpanel"
                             aria-labelledby="open-districts-tab">

                            @include('admin.districts._table',['districts'=>$open_districts])


                        </div>
                        <div class="tab-pane fade" id="blocked-district" role="tabpanel" aria-labelledby="sub-cat-tab">

                            @include('admin.districts._table',['districts'=>$blocked_districts])

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
