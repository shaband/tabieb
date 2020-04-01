<div class="appointment-time-item">
    <input type="hidden" name="{{$slot}}[day]" value="{!! $day_number !!}">
    <input type="hidden" name="{{$slot}}[id]" value="{!! $schedule['id']??null !!}">
    <div class="row">
        <div class="col-5">
            <div class="form-group">
                <label>{{ __('from')}}:</label>
                <input type="time" name="{{$slot}}[from_time]" class="{{--timepicker--}} form-control"
                       value="{!!$schedule['from_time']??null !!}"/>
            </div>
        </div>
        <div class="col-5">
            <div class="form-group">
                <label>{{ __('to') }}:</label>
                <input type="time" name="{{$slot}}[to_time]" class="{{--timepicker--}} form-control"
                       value="{!! $schedule['to_time']??null !!}"/>
            </div>
        </div>
        <div class="col-2">
            <a class="btn btn-danger text-white" onclick="removeItem(this)"><i class="fas fa-times"></i></a>
        </div>
    </div>
</div>
