@extends('admin.layouts.app')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">{!! __("Admins") !!}</h4>
                <div class="mt-0 header-title float-right  d-inline">

                    <a class="btn btn-info text-white" href="{!! route('admin.admins.create') !!}">
                        <i class="fas fa-plus"></i> {!! __("New")!!}</a>
                </div>
                <div class="pt-4">
                    @include('admin.admins._table')
                </div>
            </div>
        </div>
    </div>


@endsection
