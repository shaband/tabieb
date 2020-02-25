@extends('admin.layouts.app')
@section('title'){!! __("Contacts") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>

                <div class="pt-4">

                    @include('admin.contacts._table')

                </div>

            </div>
        </div>
    </div>


@endsection
