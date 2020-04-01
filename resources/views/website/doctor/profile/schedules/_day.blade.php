<div class="appointment-day-item form-group d-block p-2">
    <div class="appointment-day-header my-2">
        <p class="text-primary font-weight-bold text-capitalize m-0">{!! $day_str !!}</p>
        <a class="add-period text-secondary text-capitalize font-reg-sm"
           onclick="addPeriod({!! $day_number !!})" style="cursor: pointer;"><i
                class="fas fa-plus-circle"></i> {{ __('add period')}}</a>
    </div>
    <div class="appointment-day-body" id="day-{{$day_number}}">
        @php($schedules=old('schedule')??$schedules)
        @foreach($schedules[$day_number] ??[] as $schedule)
            <?php $slot = "schedule[$day_number][" . $loop->index . "]"; ?>
            @include('website.doctor.profile.schedules.schedule_row')
        @endforeach
    </div>
</div>

