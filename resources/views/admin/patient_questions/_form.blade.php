<div class="form-group">
    <label for="name_ar">{!! __("Question In Arabic") !!} *</label>
    {!! Form::text('name_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'name_ar','required','placeholder'=>__('Enter Question In Arabic')]) !!}
    @error('name_ar')
    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group">
    <label for="name_en">{!! __("Question In English") !!} *</label>
    {!! Form::text('name_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'name_en','required','placeholder'=>__('Enter Question In English')]) !!}
    @error('name_en')
    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
