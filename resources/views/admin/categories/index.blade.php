@extends('admin.layouts.app')
@section('title') {!! __("Categories") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>
                @can('Create Category')
                <div class="mt-0 header-title float-right  d-inline">

                    <a class="btn btn-info text-white" href="{!! route('admin.categories.create') !!}">
                        <i class="fas fa-plus"></i> {!! __("New")!!}</a>
                </div>
                @endcan
                <div class="pt-4">

                    <nav>
                        <div class="nav nav-tabs" id="categories-tab" role="tablist">
                            <a class="nav-item nav-link active" id="main-cat-tab`" data-toggle="tab"
                               href="#main-category" role="tab" aria-controls="main-category"
                               aria-selected="true">{!! __("Main Categories") !!}</a>
                            <a class="nav-item nav-link" id="sub-cat-tab" data-toggle="tab" href="#sub-category"
                               role="tab" aria-controls="sub-category"
                               aria-selected="false">{!! __("Sub Categories") !!}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="categories-tabContent">
                        <div class="tab-pane fade show active" id="main-category" role="tabpanel"
                             aria-labelledby="main-cat-tab`">

                            @include('admin.categories._table',['categories'=>$categories,'type'=>'main'])

                        </div>
                        <div class="tab-pane fade" id="sub-category" role="tabpanel" aria-labelledby="sub-cat-tab">

                            @include('admin.categories._table',['categories'=>$sub_categories,'type'=>'sub'])

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
