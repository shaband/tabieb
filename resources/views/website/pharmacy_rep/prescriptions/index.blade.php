@extends('website.pharmacy_rep.layouts.app')

@section('title') {!! __("Pharmacy Reps") !!} @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="mt-0 header-title d-inline">@yield('title')</h4>


                <div class="mt-0 header-title float-right d-inline">


                </div>
                <div class="pt-4">
                    <form method="get" action="{!! route('pharmacy.prescriptions.search') !!}">
                        <div class="row">


                            <div class="form-group col-md-5 col-sm-12">
                                <label>{!! __("Patient Civil id") !!} </label>
                                <input name="civil_id" type="number" required
                                       value="{!! $civil_id??old('civil_id') !!}"
                                       placeholder="{!! __("Patient Civil id") !!}" class="form-control">
                            </div>

                            <div class="form-group col-md-5 col-sm-12">
                                <label>{!! __("Prescription Code") !!} </label>
                                <input name="code" type="number" placeholder="{!! __("Prescription Code") !!}"
                                       class="form-control" value="{!!$code?? old('code') !!}">
                            </div>

                            <div class="form-group text-right mb-0 col-md-2  col-sm-2">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit" style="margin-top: 1.8rem!important;">
                                    {!! __("Search") !!}
                                </button>
                                 </div>
                        </div>

                    </form>

                    @includeWhen(isset($prescription) &&!empty($prescription),'website.pharmacy_rep.prescriptions.show')
                </div>
            </div>
        </div>
    </div>


@endsection
