@extends('website.patient.profile.profile_layout')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('form')
    <form action="" class="basic-form form-sm form-label-inline">
        @csrf
        @method('post')
        <div class="user-img-upload">
            <input id="up-user-img" name="image" type="file">
            <label for="up-user-img">
                <div class="user-img"><img src="{{asset($user->img)}}"></div>
                <div class="upload-icon bg-secondary text-white"><i
                        class="fas fa-camera"></i></div>
            </label>
        </div>
        <div class="form-group">
            <label for="">{{ __('user name')}}:</label>
            <input type="text" name="username" class="form-control"
                   value="{{ old('username')}}">
        </div>
        <div class="form-group">
            <label for="">{{ __('phone number')}}:</label>
            <input type="number" name="phone" class="form-control" value="{{old('phone')}}">
        </div>
        <div class="form-group">
            <label for="">email address:</label>
            <input type="email" class="form-control" value="{{old('email')}}">
        </div>
        <div>
            <button
                class="btn btn-thirdly btn-sm text-capitalize">{{ __('save changes')}}</button>
        </div>
    </form>

@endsection
