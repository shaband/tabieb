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
                        <div class="single-day-times"
                             data-item='{!! json_encode($time + ['doctor_id'=>$doctor->id],true); !!} '
                             onclick="timeChoosed{!! $doctor->id !!}(this)"
                        >
                            <div class="single-time single-time-{!! $doctor->id !!}
                            @if($time['has_reservation']!=0) disabled @endif ">
                                <span>{{$time['start']->format("H:i")}}</span>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endforeach

    </div>

    <form id="reservation-form-doctor-{{$doctor->id}}" action="{!! route('reservation.reserve') !!}" method="post">
        @method('post')
        {!! csrf_field() !!}
        <input id="doctor-{{$doctor->id}}-schedule_id" name="schedule_id" type="hidden">
        <input id="doctor-{{$doctor->id}}-doctor_id" name="doctor_id" type="hidden">
        <input id="doctor-{{$doctor->id}}-start" name="start" type="hidden">
        <input id="doctor-{{$doctor->id}}-has_reservation" name="has_reservation" type="hidden">
        <input id="doctor-{{$doctor->id}}-end" name="end" type="hidden">
    </form>
    <div class="doc-appointments-controls mt-3 text-center">
        <button type="submit" form="reservation-form-doctor-{{$doctor->id}}"
                class="btn btn-thirdly btn-sm text-capitalize">{{ __('book &
                                                proceed to
                                                payment')}}</button>
    </div>
    <!-- END Doctor Available Dates and Times Block -->
</div>
<script>
    function timeChoosed{!! $doctor->id !!}(el) {
        var data = JSON.parse(el.dataset.item);
        pushReservationInfoInToForm(data);
        var active_period = $(el).find('.single-time-{!! $doctor->id !!}');
        addActiveToPeriod(active_period)

    }

    function pushReservationInfoInToForm(data) {
        for (datum in data) {
            try {
                $('#doctor-{{$doctor->id}}-' + datum).val(data[datum]);

            } catch (e) {
                console.error(e.mess)
            }
        }

    }

    function addActiveToPeriod(period) {
        $('.single-time-{!! $doctor->id !!}').removeClass('active');
        period.addClass('active');
    }

</script>
