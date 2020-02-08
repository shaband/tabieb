<div class="form-group">
    <label for="doctor_id">{!! __("Select Doctor") !!} * </label>
    {!! Form::select('doctor_id',$doctors??[],null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'doctor_id','parsley-trigger'=>'change',
'required','placeholder'=>__('Doctor')]) !!}
    @error('doctor_id')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="day">{!! __("Select Day") !!} * </label>
    {!! Form::select('day',days(),null,['class'=>'form-control select2','parsley-trigger'=>'change','id'=>'day','parsley-trigger'=>'change',
'required','placeholder'=>__('Day')]) !!}
    @error('day')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="from_time">{!! __("From") !!} * </label>
    {!! Form::text('from_time',null,['class'=>'form-control timepicker','parsley-trigger'=>'change','id'=>'from_time','parsley-trigger'=>'change',
'required','placeholder'=>__('From')]) !!}
    @error('from_time')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="to_time">{!! __("To") !!} * </label>
    {!! Form::text('to_time',null,['class'=>'form-control timepicker','parsley-trigger'=>'change','id'=>'to_time','parsley-trigger'=>'change',
'required','placeholder'=>__('To')]) !!}
    @error('to_time')
    <span class="invalid-feedback d-block" role="alert">
     <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


