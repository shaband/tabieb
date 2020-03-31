@extends('website.patient.profile.profile_layout')
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

    {!! Form::model($user,['class'=>'basic-form  form-label-inline','method'=>'post','files'=>'true']) !!}

    @method('post')
    <div class="user-img-upload">
        <input id="up-user-img" name="image" type="file" onchange="readURL(this,'up-user-img-preview')">
        <label for="up-user-img">
            <div class="user-img"><img id="up-user-img-preview" src="{{asset($user->img)}}"></div>
            <div class="upload-icon bg-secondary text-white"><i
                    class="fas fa-camera"></i></div>
        </label>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="username">{!! __("Username") !!}:</label>
                {!! Form::text('username',null,['class'=>'form-control','id'=>'username']) !!}
            </div>
            @error('username')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="first_name">{{ __('first name')}}:</label>
                {!! Form::text('first_name',null,['class'=>'form-control','id'=>'first_name']) !!}
            </div>
            @error('first_name')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="last_name">{{ __('last name')}}:</label>
                {!! Form::text('last_name',null,['class'=>'form-control','id'=>'last_name']) !!}
            </div>

            @error('last_name')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label>{!! __("Phone number") !!}:</label>
                {!! Form::number('phone',null,['class'=>'form-control']) !!}
            </div>
            @error('phone')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="email">{{ __('Email Address')}}:</label>
                {!! Form::text('email',null,['class'=>'form-control','id'=>'email']) !!}
            </div>

            @error('email')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="civil_id">{{ __('Civil id')}}:</label>
                {!! Form::text('civil_id',null,['class'=>'form-control','id'=>'civil_id']) !!}
            </div>

            @error('civil_id')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="birthdate">{{ __('Birth Date')}}:</label>
                {!! Form::text('birthdate',null,['class'=>'form-control datepicker','id'=>'birthdate']) !!}
            </div>

            @error('birthdate')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>


        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="">{!! __("Social security") !!}:</label>
                {!! Form::select('social_security_id',$social_securities,null,['class'=>'form-control']) !!}
            </div>
            @error('social_security_id')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>


        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label>{{ __('Social security expired at')}}:</label>
                {!! Form::text('social_security_expired_at',null,['class'=>'form-control datepicker','id'=>'social_security_expired_at']) !!}
            </div>

            @error('social_security_expired_at')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>


        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="">{{ __('gender')}}:</label>
                {!! Form::select('gender',[1=>__("Male"),2=>__("Female")],null,['class'=>'form-control select2']) !!}

            </div>

            @error('gender')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

    </div>


    <div>
        <button
            class="btn btn-thirdly btn-sm text-capitalize">{{ __('save changes')}}</button>
    </div>
    {!! Form::close() !!}
@endsection
@push('scripts')
    <script>

        function readURL(input,id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+id)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endpush
