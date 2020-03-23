@extends('website.patient.profile.profile_layout')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('form')

    <div class="heading-blk mb-2">
        <h5 class="heading-tit-wz-after font-weight-bold">{{ __('personal')}} <span
                class="text-secondary">{{ __('information')}}</span><br><img
                src="{!! asset('design/images/heading-after.png') !!}"></h5>
    </div>
    <form class="basic-form form-label-inline form-secondaryLight">

        <div class="form-group">
            <label for="">{{ __('user name')}}:</label>
            <input type="text" class="form-control" value="{{$user->name}}" disabled>
        </div>
        <div class="form-group">
            <label for="">email address:</label>
            <input type="email" class="form-control" value="{{$user->email}}" disabled>
        </div>{{--
        <div class="form-group">
            <label for="">phone number:</label>
            <input type="number" class="form-control" value="{{$user->phone}}" disabled>
        </div>
        <div class="form-group form-group-wz-absolute-btn">
            <label for="">my wallet balance:</label>
            <input type="text" class="form-control" value="2564 RS" disabled>
            <a href="payment.html" class="btn btn-thirdlyLight btn-sm absolute-btn">charge now</a>
        </div>--}}
    </form>
    <div class="heading-blk mb-2 mt-2">
        <h5 class="heading-tit-wz-after font-weight-bold">{{ __('medical')}} <span
                class="text-secondary">{{ __('information')}}</span><br><img
                src="{!! asset('design/images/heading-after.png') !!}"></h5>
    </div>
    <form
        method="post"
        action="{!! route('patient.profile.patient-questions') !!}" class="form-md form-plain">
        @csrf
        @method('put')
        @foreach($patient_questions as $question)
            {{--       <div class="text-primary text-capitalize font-weight-bold mb-1">{{ __('medical insurance')}}:</div>--}}
            <div class="text-secondary text-capitalize font-weight-bold mt-2 mb-1">{{$question->name}}</div>
            <div class="row">
                <div class="col-6 col-sm-3">
                    <div class="custom-control custom-radio">
                        <input type="hidden" name="answers[{{$loop->iteration}}][question_id]" value="{!! $question->id !!}">
                        <input type="radio" class="custom-control-input" id="customRadio-{{$loop->iteration}}-yes"
                               name="answers[{{$loop->iteration}}][status]" value="1"
                               @if($question->status==1) checked @endif >
                        <label class="custom-control-label"
                               for="customRadio-{{$question->id}}-yes"><span>{{ __('yes')}}</span></label>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customRadio-{{$question->id}}-no"
                               name="answers[{{$loop->iteration}}][status]" @if($question->status==1) checked
                               @endif value="0">
                        <label class="custom-control-label"
                               for="customRadio-{{$question->id}}-no">
                            <span>    {{ __('no')}} </span> </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <label class="text-nowrap m-0">{{ __("Description")}}:</label>
                        <input type="text" name="answers[{{$loop->iteration}}][answer]" class="form-control py-0 h-auto"
                               placeholder="illness name here" value="{!! $question->answer !!}">
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-3">
            <button type="submit" class="btn btn-thirdly btn-sm text-capitalize">
                {{ __("Save")}}</button>
        </div>


    </form>
    </div>
@endsection
