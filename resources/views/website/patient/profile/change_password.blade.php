@extends('website.patient.profile.profile_layout')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('form')
    <form action="{!! route('patient.profile.update') !!}" class="basic-form form-sm form-label-inline" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="">{{ __('old password')}}:</label>
            <input type="password" name="old_password" class="form-control" placeholder="{{ __('enter old password')}}">
        </div>
        <div class="form-group">
            <label for="">{{ __('new password')}}:</label>
            <input type="password" name="{{ __('password')}}" class="form-control"
                   placeholder="{{ __('enter new password')}}">
        </div>
        <div class="form-group">
            <label for="">{{ __("confirm password")}}:</label>
            <input type="password" name="{{ __('password_confirmation')}}" class="form-control"
                   placeholder="{{ __('confirm new password')}}">
        </div>
        <div>
            <button class="btn btn-thirdly btn-sm text-capitalize">{{ __("Change Password")}}</button>
        </div>
    </form>
@endsection
