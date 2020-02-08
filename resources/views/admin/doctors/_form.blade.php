<div class="form-group">
    <label for="first_name_ar">{!! __("First Name In Arabic") !!} *</label>
    {!! Form::text('first_name_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'first_name_ar','required','placeholder'=>__('Enter First Name In Arabic')]) !!}
    @error('first_name_ar')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="last_name_ar">{!! __("Last Name In Arabic") !!} *</label>
    {!! Form::text('last_name_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'last_name_ar','required','placeholder'=>__('Enter Last Name In Arabic')]) !!}
    @error('last_name_ar')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="first_name_en">{!! __("First Name In English") !!} *</label>
    {!! Form::text('first_name_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'first_name_en','required','placeholder'=>__('Enter First Name In English')]) !!}
    @error('first_name_en')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="last_name_en">{!! __("Last Name In English") !!} *</label>
    {!! Form::text('last_name_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'last_name_en','required','placeholder'=>__('Enter Last Name In English')]) !!}
    @error('last_name_en')
    <span class="invalid-feedback d-block" role="alert">
       <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="description_ar">{!! __("Description In Arabic") !!} </label>
    {!! Form::textarea('description_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'description_ar','required','placeholder'=>__('Enter Description In Arabic')]) !!}
    @error('description_ar')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="description_en">{!! __("Description In English") !!} </label>
    {!! Form::textarea('description_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'description_en','required','placeholder'=>__('Enter Description In English')]) !!}
    @error('description_en')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="title_ar">{!! __("Title In Arabic") !!} *</label>
    {!! Form::text('title_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'title_ar','required','placeholder'=>__('Enter Title In Arabic')]) !!}
    @error('title_ar')
    <span class="invalid-feedback d-block" role="alert">
       <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="title_en">{!! __("Title In English") !!} *</label>
    {!! Form::text('title_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'title_en','required','placeholder'=>__('Enter Title In English')]) !!}
    @error('title_en')
    <span class="invalid-feedback d-block" role="alert">
       <strong>{{ $message }}</strong>
     <span>
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
    <label for="price">{!! __("Price") !!} *</label>
    {!! Form::number('price',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'price',"data-parsley-type"=>"integer",'required','placeholder'=>__('Enter Price')]) !!}
    @error('price')
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
    <label for="category_id">{!! __("Select Main Category ") !!} </label>
    {!! Form::select('category_id',$main_categories??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'category_id','placeholder'=>__('Main Category'),'onChange'=>'getSubCategoriesOptions(this.value)']) !!}
    @error('category_id')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="sub_category_ids">{!! __("Select Sub Categories") !!} </label>
    {!! Form::select('sub_category_ids[]',$sub_categories??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'sub_category_ids','placeholder'=>__('Main Sub Categories'),'multiple']) !!}
    @error('sub_category_ids')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
    @error('sub_category_ids.*')
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
    <label for="pass1">{!! __("Password") !!} @if(!isset($doctor)) * @endif</label>
    <input id="pass1" name="password" type="password" placeholder="{!! __("Password") !!}" @if(!isset($doctor)) required
           @endif
           class="form-control">
    @error('password')
    <span class="invalid-feedback d-block" role="alert">
       <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="passWord2">{!! __("Confirm Password") !!} @if(!isset($doctor)) * @endif</label>
    <input data-parsley-equalto="#pass1" name="password_confirmation" type="password" @if(!isset($doctor)) required
           @endif
           placeholder="{!! __("Confirm Password") !!}" class="form-control" id="passWord2">
</div>
<div class="form-group">
    <label for="image">{!!__("image")  !!}</label>
    <input type="file" name="image" class="dropify"
           @if(isset($doctor))data-default-file="{!! url($doctor->img) !!}" @endif />
    @error('image')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

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

</script>
