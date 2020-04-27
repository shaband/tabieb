@extends('website.pharmacy_rep.layouts.app')
@section('title') {!! __("Prescriptions") !!}  @endsection
@section('content')
    <div class="col-xl-12">
        <div class="card-box">

            <h4 class="header-title mt-0 mb-3">@yield('title')</h4>
            {!! Form::model($pharmacy_rep,['route'=>['pharmacy.pharmacy-reps.update',$pharmacy_rep->id],'method'=>'put','data-parsley-validate','novalidate','files'=>'true']) !!}

            @include('website.pharmacy_rep.pharmacy_reps._form')
            <div class="form-group text-right mb-0">
                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                    {!! __("Save Edits") !!}
                </button>
                <button type="reset" class="btn btn-secondary waves-effect waves-light">
                    {!! __("Cancel") !!}
                </button>
            </div>

            {!! Form::close() !!}

        </div>
    </div><!-- end col -->

@endsection
