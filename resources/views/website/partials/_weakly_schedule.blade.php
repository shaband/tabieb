<div class="doc-aval-times">
    <div class="owl-carousel">
        @foreach($doctor->weakly_schedules as $schedule)
        <div class="item">
            <div class="single-day">
                <div class="single-day-date">
                    {{$schedule->day->format('D-d M') }}</div>
                @foreach($schedule->reservation_times as $time)
                <div class="single-day-times">
                    <div class="single-time @if($time['has_reservation']!=0) disabled @endif ">
                        <span>{{$time['form_time']}}</span></div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>