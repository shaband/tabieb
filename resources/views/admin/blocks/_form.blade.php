<div class="form-group">
    <label for="name_ar">{!! __("Name In Arabic") !!} *</label>
    {!! Form::text('name_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'name_ar','required','placeholder'=>__('Enter Name In Arabic')]) !!}
    @error('name_ar')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
     </span>
    @enderror
</div>
<div class="form-group">
    <label for="name_en">{!! __("Name In English") !!} *</label>
    {!! Form::text('name_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'name_en','required','placeholder'=>__('Enter Name In English')]) !!}
    @error('name_en')
    <span class="invalid-feedback d-block" role="alert">
      <strong>{{ $message }}</strong>
     </span>
    @enderror
</div>


<div class="form-group">
    <label for="area_id">{!! __("Select Area") !!} * </label>
    {!! Form::select('area_id',$areas??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'area_id','parsley-trigger'=>'change',
'required','placeholder'=>__('Main Area')]) !!}
    @error('area_id')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


