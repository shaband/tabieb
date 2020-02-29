<div class="form-group">
    <label for="name_ar">{!! __("Name In Arabic") !!} *</label>
    {!!
    Form::text('name_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'name_ar','required','placeholder'=>__('Enter
    Name In Arabic')]) !!}
    @error('name_ar')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="name_en">{!! __("Name In English") !!} *</label>
    {!!
    Form::text('name_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'name_en','required','placeholder'=>__('Enter
    Name In English')]) !!}
    @error('name_en')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="emailAddress">{!! __("Email address") !!} *</label>
    {!!
    Form::email('email',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'emailAddress','required','placeholder'=>__('Enter
    Email Address')]) !!}
    @error('email')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="phone">{!! __("Phone") !!} *</label>
    {!!
    Form::text('phone',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'phone',"data-parsley-type"=>"integer",'required','placeholder'=>__('Enter
    Phone')]) !!}
    @error('phone')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

</div>

<div class="form-group">
    <label for="address_ar">{!! __("Address In Arabic") !!} *</label>
    {!!
    Form::text('address_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'address_ar','required','placeholder'=>__('Enter
    Address In Arabic')]) !!}
    @error('address_ar')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="address_en">{!! __("Address In English") !!} *</label>
    {!!
    Form::text('address_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'address_en','required','placeholder'=>__('Enter
    Address In English')]) !!}
    @error('address_en')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="category_id">{!! __("Select District") !!} </label>
    {!! Form::select('district_id',$districts??[],null,['class'=>'form-control
    select2','parsley-trigger'=>'change','id'=>'district_id','placeholder'=>__('Districts'),'onChange'=>'getAreasOptions(this.value)'])
    !!}
    @error('district_id')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="area_id">{!! __("Select Area") !!} </label>
    {!! Form::select('area_id',$areas??[],null,['class'=>'form-control
    select2','parsley-trigger'=>'change','id'=>'area_id','placeholder'=>__('Area'),'onChange'=>'getBlockOptions(this.value)'])
    !!}
    @error('area_id')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="block_id">{!! __("Select Block") !!} </label>
    {!! Form::select('block_id',$blocks??[],null,['class'=>'form-control
    select2','parsley-trigger'=>'change','id'=>'block_id','placeholder'=>__('Block'),'change'=>'getBlocks(this.value)'])
    !!}
    @error('block_id')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="image">{!!__("image") !!}</label>
    <input type="file" name="image" class="dropify" @if(isset($pharmacy))data-default-file="{!! url($pharmacy->img) !!}"
        @endif />
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
            url: route('api.district.areas'),
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
            url: route('api.area.blocks'),
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
