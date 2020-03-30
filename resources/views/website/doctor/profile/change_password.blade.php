@extends('website.doctor.profile.profile_layout')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('form')
    <div class="heading-blk mb-2">
        <h5 class="heading-tit-wz-after font-weight-bold">
            {{ __('edit')}} <span
                class="text-secondary">{{ __('information')}}</span><br><img
                src=" {!! asset('design/images/heading-after.png') !!}"></h5>
    </div>
    <form action="{!! route('doctor.profile.update') !!}" class="basic-form form-sm form-label-inline" method="post">
        {!! csrf_field() !!}
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
