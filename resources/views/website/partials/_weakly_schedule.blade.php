<div class="doc-aval-times">
    <div class="owl-carousel">
        @foreach($doctor->weakly_schedules as $schedule)
        <div class="item">
            <div class="single-day" style=" overflow-y: scroll; height: 254px

             ">
                <div class="single-day-date">
                    {{$schedule['day']->format('D-d') }}
                    <br>
                    {{$schedule['day']->format('M') }}
                </div>
                @foreach($schedule['times'] as $time)
                <div class="single-day-times">
                    <div class="single-time
                    @if($time['has_reservation']!=0) disabled @endif ">
                        <span>{{$time['start']->format("H:i")}}</span>

                    </div>
                </div>
                @endforeach

            </div>
        </div>
        @endforeach

    </div>
</div>
