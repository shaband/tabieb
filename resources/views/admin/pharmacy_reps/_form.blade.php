
<div class="form-group">
    <label for="pharmacy_id">{!! __("Select Pharmacy") !!} </label>
    {!! Form::select('pharmacy_id',$pharmacies??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'pharmacy_id','placeholder'=>__('Pharmacies')]) !!}
    @error('pharmacy_id')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="name">{!! __("Name") !!} *</label>
    {!! Form::text('name',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'name','required','placeholder'=>__('Enter Name')]) !!}
    @error('name')
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
    <label for="pass1">{!! __("Password") !!} @if(!isset($admin)) * @endif</label>
    <input id="pass1" name="password" type="password" placeholder="{!! __("Password") !!}" @if(!isset($admin)) required
           @endif
           class="form-control">
    @error('password')
    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group">
    <label for="passWord2">{!! __("Confirm Password") !!} @if(!isset($admin)) * @endif</label>
    <input data-parsley-equalto="#pass1" name="password_confirmation" type="password" @if(!isset($admin)) required
           @endif
           placeholder="{!! __("Confirm Password") !!}" class="form-control" id="passWord2">
</div>
<div class="form-group">
    <label for="image">{!!__("image")  !!}</label>
    <input type="file" name="image" class="dropify"
           @if(isset($admin))data-default-file="{!! url($admin->img) !!}" @endif />
    @error('image')
    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
