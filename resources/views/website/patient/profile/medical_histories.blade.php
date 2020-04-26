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
    <div class="basic-form form-label-inline form-secondaryLight">

        <div class="form-group">
            <label for="">{{ __('user name')}}:</label>
            <input type="text" class="form-control" value="{{$user->name}}" disabled>
        </div>
        <div class="form-group">
            <label for="">{{ __('email address')}}:</label>
            <input type="email" class="form-control" value="{{$user->email}}" disabled>
        </div>
        <div class="form-group">
            <label for="">{{ __('phone number')}}:</label>
            <input type="number" class="form-control" value="{{$user->phone}}" disabled>
        </div>
        {{--<div class="form-group form-group-wz-absolute-btn">
            <label for="">my wallet balance:</label>
            <input type="text" class="form-control" value="2564 RS" disabled>
            <a href="payment.html" class="btn btn-thirdlyLight btn-sm absolute-btn">charge now</a>
        </div>--}}
    </div>


    <div class="heading-blk-2-sides">
        <div class="heading-blk mb-2 mt-2">
            <h5 class="heading-tit-wz-after font-weight-bold">{{ __('medical')}} <span
                    class="text-secondary">{{ __('history')}}</span><br><img
                    src="{{ asset('design/images/heading-after.png')}}">
            </h5>
        </div>
        <a data-toggle="modal" data-target="#med-his-modal" class="btn btn-secondary text-capitalize btn-sm px-4">{{ __("add
            new")}}</a>
    </div>
    <div class="med-his-container">
        @foreach($medical_histories as $history)
            <div class="med-his-item">
                <div class="med-his-head">
                    <div class="tit-time mb-2">
                        <h6 class="tit text-primary m-0">{{$history->title}}</h6>
                        <div class="time text-secondary">{{ $history->date}} </div>
                    </div>
                    <div class="med-his-usr mb-2 text-capitalize text-secondary bg-secondaryLight">{{ __('added by')}}
                        {{optional($history->creator)->name}}
                    </div>
                </div>
                <div class="med-his-body mb-2">
                    {{$history->description}}
                </div>
                @if(optional($history->image)->file!=null)
                    <div class="med-his-foot">
                        <a href="{{asset(optional($history->image)->file)}}" class="text-secondary text-capitalize"
                           target="_blank">{{ __('show prescription file')}}</a>
                    </div>
                @endif
            </div>
        @endforeach

    </div>
@endsection

@push('footer')


    <div>
        <div class="modal fade" id="med-his-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-close">
                            <a href="javascript:void(0)" class="text-light" data-dismiss="modal" aria-label="Close"><i
                                    class="far fa-times-circle"></i></a>
                        </div>
                        <div class="heading-blk mb-2 mt-2">
                            <h6 class="heading-tit-wz-after font-weight-bold">{{ __('add new medical')}} <span
                                    class="text-secondary">{{ __('information')}}</span><br><img
                                    src="{{asset('design/images/heading-after.png')}}"></h6>
                        </div>
                        <form class="form-label-inline" method="post" enctype="multipart/form-data"
                              id="add-medical-history">
                            {!! csrf_field() !!}
                            <input type="hidden" name="patient_id" value="{!! $user->id !!}">
                            <div class="form-group">
                                <label>{{ __('disease name')}}:</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            @error('title')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            <div class="form-group">
                                <label>{{ __('date')}}:</label>
                                <input type="text" name="date" class="form-control datepicker">
                            </div>
                            @error('date')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div class="form-group d-block">
                                <label for="desc1">{{ __('Description')}}:</label>
                                <textarea id="desc1" name="description" class="form-control"></textarea>
                            </div>
                            @error('description')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div class="up-control-container up-field-container">
                                <input id="doc-up" type="file" name="image" class="d-none up-field">
                                <label for="doc-up" class="up-control m-0 text-uppercase cursor-pointer">
                                    <span>{{ __('upload document')}}</span>
                                    <span class="btn btn-secondary btn-sm">{{ __('upload document')}}</span>
                                </label>
                                <div class="uploads"></div>
                            </div>
                            @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <button class="btn btn-thirdly text-capitalize mt-3">{{ __('save changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! JsValidator::formRequest('App\Http\Requests\Website\MedicalHistoryRequest')->selector('#add-medical-history') !!}

@endpush
