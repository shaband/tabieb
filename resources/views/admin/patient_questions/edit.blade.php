@extends('admin.layouts.app')
@section('title') {!! __("Edit Patient Question") !!} : {!! $patient_question->name !!} @endsection

@section('content')
    <div class="col-xl-12">
        <div class="card-box">

            <h4 class="header-title mt-0 mb-3">@yield('title')</h4>
            {!! Form::model($patient_question,['route'=>['admin.patient-questions.update',$patient_question->id],'method'=>'put','data-parsley-validate','novalidate','files'=>'true']) !!}

            @include('admin.patient_questions._form')
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
