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
