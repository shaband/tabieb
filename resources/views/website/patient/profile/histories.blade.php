@extends('website.patient.profile.profile_layout')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('form')
    <div class="apps-container">
        @foreach($reservations as $reservation)
            @include('website.partials._reservation_card')
        @endforeach

    </div>

@endsection
