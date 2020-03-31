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
    {!! Form::model($user,['class'=>'basic-form  form-label-inline','method'=>'post']) !!}

    <div class="user-img-upload">
        <input id="up-user-img" name="image" type="file" onchange="readURL(this,'up-user-img-view')">
        <label for="up-user-img">
            <div class="user-img"><img id="up-user-img-view" src="{{asset($user->img)}}"></div>
            <div class="upload-icon bg-secondary text-white"><i
                    class="fas fa-camera"></i></div>
        </label>
    </div>


    <div class="row">

        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="first_name_ar">{{ __('first name (Ar)')}}:</label>
                {!! Form::text('first_name_ar',null,['class'=>'form-control','id'=>'first_name_ar']) !!}
            </div>
            @error('first_name_ar')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="last_name_ar">{{ __('last name (Ar)')}}:</label>
                {!! Form::text('last_name_ar',null,['class'=>'form-control','id'=>'last_name_ar']) !!}
            </div>

            @error('last_name_ar')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="first_name_en">{{ __('first name (En)')}}:</label>
                {!! Form::text('first_name_en',null,['class'=>'form-control','id'=>'first_name_en']) !!}
            </div>
            @error('first_name_en')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="last_name_en">{{ __('last name (En)')}}:</label>
                {!! Form::text('last_name_en',null,['class'=>'form-control','id'=>'last_name_en']) !!}
            </div>

            @error('last_name_en')
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
                <label for="">{!! __("Category") !!}:</label>
                {!! Form::select('category_id',$categories,null,['class'=>'form-control','onChange'=>'getSubCategoriesOptions(this.value)']) !!}
            </div>
            @error('category_id')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>

        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="">{!! __("Sub Category") !!}:</label>
                {!! Form::select('sub_category_ids[]',$sub_categories,null,['class'=>'form-control select2','multiple','placeholder'=>"select Sub Category"]) !!}
            </div>
            @error('sub_category_ids[]')
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
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="">{!! __("Price") !!}:</label>
                {!! Form::number('price',null,['class'=>'form-control']) !!}

            </div>

            @error('price')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="heading-blk mb-2 mt-2">
        <h5 class="heading-tit-wz-after font-weight-bold">{{ __("Prescription")}} <span
                class="text-secondary">{{ __('information')}}</span><br><img
                src="{{asset('design/images/heading-after.png')}}"></h5>
    </div>
    <div class="user-img-upload mb-3">
        <input id="up-user-img2" type="file" name="logo" onchange="readURL(this,'up-user-log-view')">
        <label for="up-user-img2">
            <div class="user-img"><img id="up-user-log-view" src="{!! asset($user->logo) !!}"></div>
            <div class="upload-icon bg-secondary text-white"><i class="fas fa-camera"></i></div>
        </label>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="username">{!! __("Doctor Name") !!}:</label>
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
                <label for="title_ar">{{ __('Title (Ar)')}}:</label>
                {!! Form::text('title_ar',null,['class'=>'form-control','id'=>'title_ar']) !!}
            </div>
            @error('title_ar')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>

        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="title_en">{{ __('Title (En)')}}:</label>
                {!! Form::text('title_en',null,['class'=>'form-control','id'=>'title_en']) !!}
            </div>
            @error('title_en')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="description_ar">{{ __('Description (Ar)')}}:</label>
                {!! Form::text('description_ar',null,['class'=>'form-control','id'=>'description_ar']) !!}
            </div>
            @error('description_ar')
            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </div>

        <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="form-group">
                <label for="description_en">{{ __('Description (En)')}}:</label>
                {!! Form::text('description_en',null,['class'=>'form-control','id'=>'description_en']) !!}
            </div>
            @error('description_en')
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

    <hr class="my-4">
    <form class="basic-form form-label-inline">
        <div class="heading-blk mb-2 mt-2">
            <h5 class="heading-tit-wz-after font-weight-bold">{{ __('appointments')}} <span
                    class="text-secondary">time</span><br><img src="{{ asset('design/images/heading-after.png')}}"></h5>
        </div>
        <div class="appointment-day-item form-group d-block p-2">
            <div class="appointment-day-header my-2">
                <p class="text-primary font-weight-bold text-capitalize m-0">sunday</p>
                <a class="add-period text-secondary text-capitalize font-reg-sm"><i class="fas fa-plus-circle"></i> add
                    period</a>
            </div>
            <div class="appointment-day-body">
                <div class="appointment-time-item">
                    <div class="row">
                        <div class="col-6">
                            <div class='form-group'>
                                <label>from:</label>
                                <input type="text" class="timepicker form-control"/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class='form-group'>
                                <label>to:</label>
                                <input type="text" class="timepicker form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="appointment-time-item">
                    <div class="row">
                        <div class="col-6">
                            <div class='form-group'>
                                <label>from:</label>
                                <input type="text" class="timepicker form-control"/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class='form-group'>
                                <label>to:</label>
                                <input type="text" class="timepicker form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="appointment-day-item form-group d-block p-2">
            <div class="appointment-day-header my-2">
                <p class="text-primary font-weight-bold text-capitalize m-0">monday</p>
                <a class="add-period text-secondary text-capitalize font-reg-sm"><i class="fas fa-plus-circle"></i> add
                    period</a>
            </div>
            <div class="appointment-day-body">
                <!-- Append Times Here -->
            </div>
        </div>
        <div class="appointment-day-item form-group d-block p-2">
            <div class="appointment-day-header my-2">
                <p class="text-primary font-weight-bold text-capitalize m-0">tuesday</p>
                <a class="add-period text-secondary text-capitalize font-reg-sm"><i class="fas fa-plus-circle"></i> add
                    period</a>
            </div>
            <div class="appointment-day-body">
                <!-- Append Times Here -->
            </div>
        </div>
        <div class="appointment-day-item form-group d-block p-2">
            <div class="appointment-day-header my-2">
                <p class="text-primary font-weight-bold text-capitalize m-0">wednesday</p>
                <a class="add-period text-secondary text-capitalize font-reg-sm"><i class="fas fa-plus-circle"></i> add
                    period</a>
            </div>
            <div class="appointment-day-body">
                <!-- Append Times Here -->
            </div>
        </div>
        <div class="appointment-day-item form-group d-block p-2">
            <div class="appointment-day-header my-2">
                <p class="text-primary font-weight-bold text-capitalize m-0">thursday</p>
                <a class="add-period text-secondary text-capitalize font-reg-sm"><i class="fas fa-plus-circle"></i> add
                    period</a>
            </div>
            <div class="appointment-day-body">
                <!-- Append Times Here -->
            </div>
        </div>
        <div class="appointment-day-item form-group d-block p-2">
            <div class="appointment-day-header my-2">
                <p class="text-primary font-weight-bold text-capitalize m-0">friday</p>
                <a class="add-period text-secondary text-capitalize font-reg-sm"><i class="fas fa-plus-circle"></i> add
                    period</a>
            </div>
            <div class="appointment-day-body">
                <!-- Append Times Here -->
            </div>
        </div>
        <div class="appointment-day-item form-group d-block p-2">
            <div class="appointment-day-header my-2">
                <p class="text-primary font-weight-bold text-capitalize m-0">saturday</p>
                <a class="add-period text-secondary text-capitalize font-reg-sm"><i class="fas fa-plus-circle"></i> add
                    period</a>
            </div>
            <div class="appointment-day-body">
                <!-- Append Times Here -->
            </div>
        </div>

        <div>
            <button class="btn btn-thirdly text-capitalize btn-sm">save changes</button>
        </div>
    </form>

@endsection
@push('scripts')
    <script>

        function getSubCategoriesOptions(category_id) {

            $.ajax({
                method: 'get',
                url: route('api.categories.sub-categories', category_id),
                success: function (res) {
                    var sub_categories = res.data;
                    var selector = 'select[name="sub_category_ids[]"]';
                    var placeholder = getPlaceholder(selector);
                    var options = placeholder + getOptions(sub_categories);
                    $(selector).html(options);

                }
            })
        }

        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + id)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>
@endpush
