@extends('website.doctor.profile.profile_layout')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('form')
    <div class="heading-blk mb-2">
        <h5 class="heading-tit-wz-after font-weight-bold">{{ __("my")}} <span
                class="text-secondary">{{ __('History')}}</span><br><img
                src=" {!! asset('design/images/heading-after.png') !!}"></h5>
    </div>
    <div class="apps-container">
        @foreach($reservations as $reservation)
            @include('website.partials._reservation_card')
        @endforeach

    </div>

@endsection
