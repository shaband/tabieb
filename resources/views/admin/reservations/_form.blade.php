{{--'doctor_id', 'patient_id', 'schedule_id', 'date', 'from_time', 'to_time', 'communication_type', 'canceled_at', 'status', 'description'--}}
<div class="form-group">
    <label for="last_name">{!! __("Last Name") !!} *</label>
    {!! Form::text('last_name',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'last_name','required','placeholder'=>__('Enter Last Name')]) !!}
    @error('last_name')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="civil_id">{!! __("Civil Id") !!} *</label>
    {!! Form::number('civil_id',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'civil_id','required','placeholder'=>__('Enter Civil Id')]) !!}
    @error('civil_id')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="birthdate">{!! __("Birthdate") !!}  </label>
    {!! Form::text('birthdate',null,['class'=>'form-control datepicker','parsley-trigger'=>'change','id'=>'birthdate','parsley-trigger'=>'change',
'required','placeholder'=>__('Birthdate')]) !!}
    @error('birthdate')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="gender">{!! __("Gender") !!} *</label>
    {!! Form::select('gender',[1=>__("Male"),2=>__("Female")],null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'gender',"data-parsley-type"=>"integer",'required','placeholder'=>__('Select Gender')]) !!}
    @error('gender')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror

</div>


<div class="form-group">
    <label for="social_security_id">{!! __("Select Social Security ") !!} </label>
    {!! Form::select('social_security_id',$social_securities??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'social_security_id','placeholder'=>__('Social Security'),]) !!}
    @error('social_security_id')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="birthdate">{!! __("Social Security Expiration Date") !!}  </label>
    {!! Form::text('social_security_expired_at',null,['class'=>'form-control datepicker','parsley-trigger'=>'change','id'=>'social_security_expired_at','parsley-trigger'=>'change',
'required','placeholder'=>__('Social Security Expiration Date')]) !!}
    @error('social_security_expired_at')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="category_id">{!! __("Select District") !!} </label>
    {!! Form::select('district_id',$districts??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'district_id','placeholder'=>__('Districts'),'onChange'=>'getAreasOptions(this.value)']) !!}
    @error('district_id')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="area_id">{!! __("Select Area") !!} </label>
    {!! Form::select('area_id',$areas??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'area_id','placeholder'=>__('Area'),'onChange'=>'getBlockOptions(this.value)']) !!}
    @error('area_id')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="block_id">{!! __("Select Block") !!} </label>
    {!! Form::select('block_id',$blocks??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'block_id','placeholder'=>__('Block'),'change'=>'getBlocks(this.value)']) !!}
    @error('block_id')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="emailAddress">{!! __("Email address") !!} *</label>
    {!! Form::email('email',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'emailAddress','required','placeholder'=>__('Enter Email Address')]) !!}
    @error('email')
    <span class="invalid-feedback d-block" role="alert">
       <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="phone">{!! __("Phone") !!} *</label>
    {!! Form::text('phone',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'phone',"data-parsley-type"=>"integer",'required','placeholder'=>__('Enter Phone')]) !!}
    @error('phone')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror

</div>
<div class="form-group">
    <label for="pass1">{!! __("Password") !!} @if(!isset($patient)) * @endif</label>
    <input id="pass1" name="password" type="password" placeholder="{!! __("Password") !!}"
           @if(!isset($patient)) required
           @endif
           class="form-control">
    @error('password')
    <span class="invalid-feedback d-block" role="alert">
       <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="passWord2">{!! __("Confirm Password") !!} @if(!isset($patient)) * @endif</label>
    <input data-parsley-equalto="#pass1" name="password_confirmation" type="password" @if(!isset($patient)) required
           @endif
           placeholder="{!! __("Confirm Password") !!}" class="form-control" id="passWord2">
</div>


<div class="form-group">
    <label for="image">{!!__("image")  !!}</label>
    <input type="file" name="image" class="dropify"
           @if(isset($patient))data-default-file="{!! url($patient->img) !!}" @endif />
    @error('image')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<script>

    function getAreasOptions(district_id) {
        $.ajax({
            method: 'post',
            url: route('api.patient.district.areas'),
            data: {district_id: district_id},
            success: function (res) {
                var areas = res.data.areas;
                var selector = 'select[name="area_id"]';
                var placeholder = getPlaceholder(selector);
                var options = placeholder + getOptions(areas);
                $(selector).html(options);
            }
        })
    }

    function getBlockOptions(area_id) {
        $.ajax({
            method: 'post',
            url: route('api.patient.area.blocks'),
            data: {area_id: area_id},
            success: function (res) {
                var block = res.data.blocks;
                var selector = 'select[name="block_id"]';
                var placeholder = getPlaceholder(selector);
                var options = placeholder + getOptions(block);
                $(selector).html(options);
            }
        });
    }

</script>
