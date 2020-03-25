@extends('website.doctor.profile.profile_layout')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('form')
    <div class="heading-blk mb-2">
        <h5 class="heading-tit-wz-after font-weight-bold">{{ __('my')}} <span
                class="text-secondary">{{ __('appointments')}}</span><br><img
                src="{{ asset('design/images/heading-after.png')}}"></h5>
    </div>
    <div class="text-center mb-3">
        <div class="doc-apps-tabs">
            <a href="{{route('doctor.profile.requests')}}" class="btn">
                {{ __('appointments requests')}}</a>
            <a href="{{route('doctor.profile.appointments')}}" class="btn">{{ __('upcoming appointments')}}</a>
            <a href="{{route('doctor.profile.history')}}" class="btn active">{{ __('history')}}</a>
        </div>
    </div>

    <div class="apps-container">
        @foreach($reservations as $reservation)
            <div class="app-item app-history @if(in_array($reservation->status,[$reservation::STATUS_REFUSED,$reservation::STATUS_CANCELED]) ) app-reject @endif ">
                <div class="app-img"><img src="{!! asset('design/images/app-doc-icon.png') !!} "></div>
                <div class="app-dets">
                    <div>
                        <b>{{ __('patient full name')}}:</b>
                        <span>{{optional($reservation->patient)->name}}</span>
                    </div>
                    <div>
                        <b>{{ __('appointment Status')}}:</b>
                        <span>{!! $reservation->status_str !!}</span>
                    </div>
                    <div>
                        <b>{{ __('appointment way')}}:</b>
                        <span>{{ $reservation->communication_type_string }}</span>
                    </div>
                    {{--
                    <div>
                        <b>{{ __('Call Summary')}}:</b>
                        <span>---</span>
                    </div>--}}
                </div>
            </div>
        @endforeach


    </div>
@endsection
