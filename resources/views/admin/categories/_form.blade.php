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
    <label for="category_id">{!! __("Select Main Category If It's Sub Category") !!} </label>
    {!! Form::select('category_id',$main_categories??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'category_id','placeholder'=>__('Main Category')]) !!}
    @error('category_id')
    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>

